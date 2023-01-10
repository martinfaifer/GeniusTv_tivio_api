<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Topics\StoreTopicAction;
use App\Actions\Admin\Topics\UpdateTopicAction;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\ShowTopicResource;
use App\Http\Resources\ShowTopicsResource;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index()
    {
        return new ShowTopicsResource(Auth::user());
    }

    public function show_parts(int $limit)
    {
        //
    }

    public function show(Topic $topic)
    {
        return new ShowTopicResource($topic);
    }

    public function store(StoreTopicRequest $request, StoreTopicAction $storeTopicAction)
    {
        return $storeTopicAction->execute($request->title, $request->text) == true
            ? $this->success_message('Článek vytvořen')
            : $this->error_message('Nepodařilo se vytvořit článek');
    }

    public function update(UpdateTopicRequest $request, Topic $topic, UpdateTopicAction $updateTopicAction)
    {
        return $updateTopicAction->execute($topic, $request->title, $request->text) == true
            ? $this->success_message('Upraveno')
            : $this->error_message('Nepodařilo se upravit');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return $this->success_message('Odebráno');
    }
}
