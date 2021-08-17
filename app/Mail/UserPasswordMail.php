<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        //เราสามารถส่ง Parameter มาจากที่อื่นได้โดยใช้ Constructor รับค่า
        $this->user=$user;
        $this->password=$password;

        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //เวลาใช้งานดึงการแสดงผลจาก View เหมือนกับ Controller ทั่วไป
        $user = User::where('id', $this->user)->get();
        $password =  $this->password;
        return $this->subject('Password PCONS')
                    ->view('email.user_password',compact(['user','password']));
    }
}
