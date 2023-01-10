<?php

namespace App\Actions\Admin\Topics;

use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class StoreTopicAction
{
    public function execute(string $title, string $text)
    {
        try {
            Topic::create([
                'title' => $title,
                'text' => $text,
                'user_id' => Auth::user()->id,
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
