<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Factory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory {model} {amount=1} {--options=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate factories';

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
        $model = $this->argument('model');
        $className = 'App\Models\\'.$model;
        $amount = (int)$this->argument('amount');
        if (class_exists($className)) {
          echo $className;
          factory($className, $amount)->create();
        }
    }
}
