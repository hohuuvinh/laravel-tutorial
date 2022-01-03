<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Carbon\Carbon;
use App\Mail\WelcomeEmail;


class JobController extends Controller
{
    /**
     * Handle Queue Process
     */
    public function processQueue()
    {	
    	
    		$emailJob = new SendWelcomeEmail();
    		dispatch($emailJob);
        
    }

    // public function processQueue(){
    //     $getEmailConfig = DB::table('user_mail_config')
    //     ->where('user_id','=',1)
    //     ->inRandomOrder()
    //     ->limit(1)
    //     ->first();
        
    // }
}