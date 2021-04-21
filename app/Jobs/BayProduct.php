<?php

namespace App\Jobs;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BayProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $operation;
    private $product_id;
    private $user_id;
    private $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($operation, $bay, $user, $id)
    {
        $this->operation = $operation;
        $this->product_id = $bay;
        $this->user_id = $user;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //  Стоймость продукта  $this->operation
        //  ID Продукта $this->product_id
        //  ID пользователя $this->user_id
        //  ID записи в операциях $this->id
            $user = User::find($this->user_id);
            $user->balance->decrement('cash', $this->operation);
           $user->operation->find($this->id)->update(['status' => true]);

       logs()->warning("Тест [{$this->operation }],[{$this->product_id}],[{$this->user_id}],[{$user->operation->find($this->id)}]");
    }
}
