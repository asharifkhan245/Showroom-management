<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $admin_token;
    public $subadmin;
    public $subadmin_token;
    public $employee;
    public $employee_token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $admin_token, $subadmin, $subadmin_token, $employee, $employee_token)
    {
        $this->admin = $admin;
        $this->admin_token = $admin_token;
        $this->subadmin = $subadmin;
        $this->subadmin_token = $subadmin_token;
        $this->employee = $employee;
        $this->employee_token = $employee_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forgetPassword')

            ->subject('Forget Password');
    }
}
