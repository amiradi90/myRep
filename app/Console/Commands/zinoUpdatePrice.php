<?php

namespace App\Console\Commands;

use App\Http\Controllers\HomeController;
use Illuminate\Console\Command;

class zinoUpdatePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:zinoUpdatePrice';

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
     * @return mixed
     */
    public function handle()
    {
        HomeController::xmlConvert(1129);
        return '1129 updated';
    }
}
