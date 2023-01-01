<?php

namespace App\Console\Commands;

use App\Models\Stb;
use App\Models\Subscriber;
use App\Models\Subscription;
use Illuminate\Console\Command;
use App\Models\SubscriptionAccount;
use App\Models\SubscriptionIdentity;

class TruncateAllUnnecessaryTablesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tables:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Smazání všech dočasných dat z tabulek ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Subscriber::truncate();
        Subscription::truncate();
        SubscriptionAccount::truncate();
        SubscriptionIdentity::truncate();
        Stb::truncate();
    }
}
