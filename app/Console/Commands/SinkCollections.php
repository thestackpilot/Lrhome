<?php

namespace App\Console\Commands;

use App\Http\Controllers\RizzyApisDataSinkerController;
use Illuminate\Console\Command;

class SinkCollections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sink:collections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Will Run Collection Sinker';

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
        $this->info('Sinking Latest Collections to DB ...');
        $main = $this->output->createProgressBar(100);
        $sinkerObj = new RizzyApisDataSinkerController;
        $sinkerObj->sinkCollections();
        $main->finish();
        $this->line('','','');
        $this->info(' Collections Sinked Successfully :)' . "\n");
    }
}
