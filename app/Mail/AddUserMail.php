<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddUserMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$email,$password;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$password)
    {
        $this->name     = $name;
        $this->email    = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('emstestv1@gmail.com','PMS')->subject('Login Credentials')->view('auth.addUserMail')->with('name',$this->name,'email',$this->email,'password',$this->password);
    }
}
