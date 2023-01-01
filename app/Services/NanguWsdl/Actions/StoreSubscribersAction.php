<?php

namespace App\Services\NanguWsdl\Actions;

use App\Models\Subscriber;

class StoreSubscribersAction
{
    public function __construct(public string $subscriberCode, public string $ispId)
    {
        $this->store();
    }

    public function store(): void
    {
        try {
            Subscriber::create([
                'subscriberCode' => $this->subscriberCode,
                'ispId' => $this->ispId
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
