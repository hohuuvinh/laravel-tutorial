<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Mail;
use App\Mail\WelcomeEmail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        
        $listMail = ['vinhhofb@gmail.com','vinhhovinhho@gmail.com','vinh44344@donga.edu.vn']; 

        for ($i = 0; $i < count($listMail); $i++) {
           $email = new WelcomeEmail();
           Mail::to($listMail[$i])->send($email);          
           sleep(15);
       }             
   }
}
