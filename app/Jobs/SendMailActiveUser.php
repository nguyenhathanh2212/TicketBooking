<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use Mail;
use Exception;

class SendMailActiveUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $password;
    public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $data = ['user' => $this->user, 'password' => $this->password];

            Mail::send('admin.email.active_user', $data, function($message){
                $message->from('thanhtdk2212@gmail.com', 'Ticket booking');
                $message->to($this->user->email)->subject('Ticket booking');
            });
        } catch(Exception $e) {
            report($e);
        }
    }
}
