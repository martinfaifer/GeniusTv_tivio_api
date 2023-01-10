<?php

namespace App\Http\Resources;

use App\Models\App;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexAppsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $output = [];
        $apps = App::get();
        foreach ($apps as $app) {
            $output[] = [
                'id' => $app->id,
                'name' => $app->name,
                'description' => $app->description,
                'path' => $app->path,
                'category' => $app->category->category,
            ];
        }

        return $output;
    }
}
