<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Carbon\Carbon;
use App\Mail\WelcomeEmail;
use DB;

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

    public function ok(){
      $getEmailCampaign= DB::table('user_mail_campaign')->where('id','=',1)->first();

      $getEmailCampaignDetail= DB::table('user_mail_campaign_details')->where('compaign_id','=',$getEmailCampaign->id)->get();
      dd($getEmailCampaignDetail);
  }
}