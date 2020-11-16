<?php

namespace App\Console\Commands;

use App\Models\Trip\TripOrderTransaction;
use Illuminate\Console\Command;

class CheckPaidCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:paid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tripOrderTransaction =  new TripOrderTransaction;
        $tripOrderTransaction->checkPaid();
    }
}
