<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $fullName,$OTP;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($fullName,$OTP)
    {
        $this->fullName = $fullName;
        $this->OTP      = $OTP;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('emstestv1@gmail.com','PMS')->subject('Login OTP')->view('auth.emailVerification')->with('fullName',$this->fullName,'OTP',$this->OTP);
    }
}
