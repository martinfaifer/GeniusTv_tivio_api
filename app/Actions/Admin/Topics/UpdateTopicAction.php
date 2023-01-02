<?php

namespace App\Actions\Admin\Topics;

class UpdateTopicAction
{
    public function execute(object $topic, string $title, string $text): bool
    {
        try {
            $topic->update([
                'title' => $title,
                'text' => $text
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
