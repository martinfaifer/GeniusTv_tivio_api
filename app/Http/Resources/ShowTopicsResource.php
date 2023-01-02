<?php

namespace App\Http\Resources;

use App\Models\Topic;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTopicsResource extends JsonResource
{

    public $result = [];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $topics = Topic::orderBy('created_at', 'desc')->take(10)->get();
        foreach ($topics as $topic) {
            $this->result[] = [
                'id' => $topic->id,
                'title' => $topic->title,
                'text' => substr($topic->text, 0, 100). " ...",
                'author' => $topic->author->name
            ];
        }

        return $this->result;
    }
}
