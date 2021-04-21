<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class upBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'up:up {user_id} {sum}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Пополнение баланса пользователю';

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
      $user = User::find($this->argument('user_id'));
      $user->balance->increment('cash', $this->argument('sum'));
      $this->info('Баланc пользователя:'.' '.$user->name.' '.'пополнен на сумму:'.$this->argument('sum'));
    }
}
