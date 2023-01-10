<?php

namespace App\Console\Commands;

use App\Models\Stb;
use App\Models\SubscriptionIdentity;
use App\Models\User;
use Illuminate\Console\Command;

class CreateCustomerByIdentityAndStbMacCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geniusTv:createUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user by identity and Stb MAC address, when mac is username and identity is password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::where('mac', '!=', null)->delete();

        $identities = SubscriptionIdentity::get();
        foreach ($identities as $identity) {
            $stbs = Stb::where('subscriptionId', $identity->subscriptionId)->get();
            foreach ($stbs as $stb) {
                try {
                    User::create([
                        'name' => $stb->mac,
                        'mac' => $stb->mac,
                        'email' => $stb->mac.'@geniustv.cz',
                        'password' => bcrypt($identity->username),
                        'identity' => $identity->id,
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
    }
}
