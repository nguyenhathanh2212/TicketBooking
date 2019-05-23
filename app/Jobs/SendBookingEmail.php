<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Models\Ticket;

class SendBookingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = ['ticket' => $this->ticket];

        try {
            Mail::send('admin.email.index', $data, function($message){
                $message->from('thanhtdk2212@gmail.com', 'Ticket booking');
                $message->to('thanhtdk2212@gmail.com')->subject('Ticket booking');
            });
        } catch(\Exception $e) {
            report($e);
        }
    }
}
