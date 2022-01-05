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

      $listMail = ['vinhhofb@gmail.com','vinhhovinhho@gmail.com','vinh44344@donga.edu.vn'];

      //lấy mẫu mail gửi thông qua session template_id
      $getEmailTemplate = DB::table('user_mail_templat')
      ->where('id','=',1)
      ->first();

      for ($i = 0; $i < count($listMail); $i++) {

        //lấy ngẫu nhiên mail config
        $getEmailConfig = DB::table('user_mail_config')
        ->where('user_id','=',1)
        ->inRandomOrder()
        ->limit(1)
        ->first();


        //Bỏ thông tin mail được lấy ngẫu nhiên vào swift smtp
        $transport = (new \Swift_SmtpTransport($getEmailConfig->mail_host,$getEmailConfig->mail_port))
        ->setUsername($getEmailConfig->mail_username)->setPassword($getEmailConfig->mail_password)->setEncryption($getEmailConfig->mail_encription);
        $mailer = new \Swift_Mailer($transport);


        //thiết lập tiêu đề, nội dung mail gửi
        $message = (new \Swift_Message($getEmailTemplate->mail_header))
        ->setFrom($getEmailConfig->mail_username)
        ->setTo($listMail[$i])
        ->setBody('Title email1')
        ->addPart(
          $getEmailTemplate->mail_content,
          'text/html'
        );

        
        $mailer->send($message);
        sleep(15);
      }             
    }
  }
