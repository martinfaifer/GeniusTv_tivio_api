<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\IndexAppsResource;
use Illuminate\Support\Facades\Validator;
use App\Events\BroadcastReloadApplicationsContentEvent;

class AppController extends Controller
{
    public function index()
    {
        return new IndexAppsResource(App::get());
    }

    public function store(Request $request)
    {
        if (App::whereName($request->file('file')->getClientOriginalName())->first()) {
            return $this->error_message('Soubor s tímto názvem již existuje');
        }

        $file = $request->file('file');
        $name = uniqid() . '.' . $file->extension();
        $file->storeAs('public/apps', $name);

        try {
            App::create([
                'name' => $request->file('file')->getClientOriginalName(),
                'description' => $request->description,
                'path' => "/storage/apps/" . $name,
                'app_category_id' => $request->category
            ]);
            return $this->success_message("Nahráno");
        } catch (\Throwable $th) {
            return $this->error_message('Již existuje');
        }
    }


    public function destroy(App $app)
    {
        // remove item
        Storage::delete($app->path);
        $app->delete();
        event(new BroadcastReloadApplicationsContentEvent());
        return $this->success_message("Odebráno");
    }
}
