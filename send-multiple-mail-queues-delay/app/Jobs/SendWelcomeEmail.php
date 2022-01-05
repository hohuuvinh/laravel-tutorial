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
use DB;


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

      //lấy ra chiến dịch mail 
      $getEmailCampaign= DB::table('user_mail_campaign')->where('id','=',1)->first();

      //lấy ra các mail để gửi 
      $getEmailCampaignDetail= DB::table('user_mail_campaign_details')->where('compaign_id','=',$getEmailCampaign->id)->get();

      $listMail = ['vinhhofb@gmail.com','vinhhovinhho@gmail.com','vinh44344@donga.edu.vn'];

      //lấy mẫu mail gửi 
      $getEmailTemplate = DB::table('user_mail_templat')
      ->where('id','=',$getEmailCampaign->mail_template_id)
      ->first();

      //chuyển %ten_nguoi_nhan% thành tên người nhận
      $titleEmailReplace = str_replace("%ten_nguoi_nhan%", "vinh", $getEmailTemplate->mail_header);

      foreach ($getEmailCampaignDetail as $items) {

        //lấy ngẫu nhiên mail config
        $getEmailConfig = DB::table('user_mail_config')
        ->where('user_id','=',$getEmailCampaign->user_id)
        ->inRandomOrder()
        ->limit(1)
        ->first();


        //Bỏ thông tin mail được lấy ngẫu nhiên vào swift smtp
        $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host,$getEmailConfig->mail_port))
        ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encription);
        $mailer = new \Swift_Mailer($transport);


        //thiết lập tiêu đề, nội dung mail gửi
        $message = (new \Swift_Message($titleEmailReplace))
        ->setFrom($getEmailConfig->mail_username)
        ->setTo($items->cus_mail)
        ->setBody('Title email1')
        ->addPart(
          $getEmailTemplate->mail_content,
          'text/html'
        );

        
        $mailer->send($message);
        sleep(60);
      }             
    }
  }
