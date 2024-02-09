<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\RizzyApisDataSinkerController;

class SinkItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sink:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Will Run Item Sinker';

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
        $this->info('Sinking Latest Items to DB ...');
        $main = $this->output->createProgressBar(100);
        $sinkerObj = new RizzyApisDataSinkerController;
        $sinkerObj->sinkItems();
        $main->finish();
        $this->line('','','');
        $this->info(' Collections Sinked Successfully :)' . "\n");
    }
}
