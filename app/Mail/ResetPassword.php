<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;


    public $admin;
    public $sub_admin;
    public $employee;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $sub_admin, $employee)
    {

        $this->admin = $admin;
        $this->sub_admin = $sub_admin;
        $this->employee = $employee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.resetPassword')

            ->subject('Reset Password');
    }
}
