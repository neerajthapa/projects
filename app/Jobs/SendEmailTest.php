<?php


namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendEmailTest as SendEmailTestMail;
use Mail;


class SendEmailTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $details;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
 
          $main = array();

          $email_body = addcslashes($this->details['email_body'] , '\`*[]()#+-.!');

          $email_body = str_replace("\\","",$email_body);
          $email_body = str_replace('\\', '', $email_body);
         

          $main['email_body'] = $email_body;
          $main['email_subject'] = $this->details['email_subject'];
          $main['details'] = $this->details['details'];
          $main['email'] = $this->details['email'];
          $main['id'] = $this->details['id'];
          $main['notification_type'] = $this->details['notification_type'];


          $email = $this->details['email'];
          $notification_type = $this->details['notification_type'];
          $id = $this->details['id'];
          $email_subject = $this->details['email_subject'];
 
          \Mail::send('emails.email_main', $main, function($message) use (  $notification_type , $email , $id,  $email_subject , $main ) 
                            {   $message->to( $email, env('APP_NAME'))->subject( env('APP_NAME').':'. $email_subject );
                                $message->from('harvindersingh@goteso.com', env('APP_NAME'));
                            });

        
 
    }
}