<?php

namespace App\Services\NanguWsdl\Actions;

use App\Models\Stb;

class StoreStbAction
{
    public function __construct(public string $mac, public string $stbType, public int $subscriptionId)
    {
        $this->store();
    }

    public function store()
    {
        Stb::create([
            'mac' => $this->mac,
            'stb_type' => $this->stbType,
            'subscriptionId' => $this->subscriptionId,
        ]);
    }
}
