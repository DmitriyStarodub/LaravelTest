<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;


  public $user;

public function __construct(User $user)
{
    $this->user = $user;
}

    /**
     * Собрать сообщение.
     *
     * @return $this
     */
    public function build()
    {
         // Create activation link.
        $activationLink = route('activation', [
            'id' => $this->user->id, 
            'token' => md5($this->user->email)
        ]);

        return $this->subject(trans('interface.UserRegistered'))
            ->view('emails.confirm')->with([
                'link' => $activationLink
            ]);
    }
}