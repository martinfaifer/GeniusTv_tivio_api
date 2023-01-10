<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Events\BroadcastFrontEndNotificationEvent;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success_message(string $message, null|string $payload = null): array
    {
        $this->send_broadcast_notification("success", $message);
        return [
            'status' => "success",
            'message' => $message,
            'payload' => $payload
        ];
    }

    public function error_message(string $message): array
    {
        $this->send_broadcast_notification("error", $message);
        return [
            'status' => "error",
            'message' => $message
        ];
    }

    public function warning(string $message)
    {
        return [
            'status' => "warning",
            'message' => $message
        ];
    }

    private function send_broadcast_notification(string $status, string $message)
    {
        try {
            event(new BroadcastFrontEndNotificationEvent(Auth::user()->id, $status, $message));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
