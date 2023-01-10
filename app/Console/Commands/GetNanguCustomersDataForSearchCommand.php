<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NanguWsdl\Stbs\NanguWsdlStbService;
use App\Services\NanguWsdl\Actions\StoreSubscribersAction;
use App\Services\NanguWsdl\Identities\NanguWsdlIdentityService;
use App\Services\NanguWsdl\Subscribers\NanguWsdlSubscribersService;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlSubscriptionsService;
use App\Services\NanguWsdl\SubscriptionAccountCodes\NanguWsdlSubscriptionAccountCodesService;
use Illuminate\Support\Facades\Artisan;

class GetNanguCustomersDataForSearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nangu:get_all_customers_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Příkaz pro získání všech dat pro získání informace o zákazníkovi';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // získání všech subscriberů a uložení do DB
        (new NanguWsdlSubscribersService('subscriber'))->get_and_store();

        // získání subscriptions a uložení do DB
        (new NanguWsdlSubscriptionsService('subscriber'))->get_and_store();

        // získání subscription Stb AccountCode a uložení do DB
        (new NanguWsdlSubscriptionAccountCodesService('subscription'))->get_and_store();

        // získání macovek stb
        (new NanguWsdlStbService('subscription'))->get_and_store();

        // získání identit
        (new NanguWsdlIdentityService('subscription'))->get_and_store();

        // create users into this system
        // Artisan::call('geniusTv:createUser');
    }
}
