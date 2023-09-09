<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sender;
    protected $subject;
    protected $data;
    protected $template_name;

    public function __construct($template_name, $data, $sender, $subject)
    {
       $this->template_name = $template_name;
       $this->data = $data;
       $this->sender = $sender;
       $this->subject = $subject;
    }
  

    public function handle()
    {
            $email = $this->sender;
            $subject = $this->subject;
            Mail::send($this->template_name, ['data' => $this->data], function($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
    }
}
