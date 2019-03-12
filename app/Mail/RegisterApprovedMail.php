<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class RegisterApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct(User $user){$this->user = $user;}

    public function build()
    {
        $user = $this->user;
        return $this->view('emails.registerApproved',compact(['user']));
    }
}
