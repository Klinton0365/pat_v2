<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $forAdmin;

    public function __construct($data, $forAdmin = false)
    {
        $this->data = $data;
        $this->forAdmin = $forAdmin;
    }

    public function build()
    {
        if ($this->forAdmin) {
            return $this->subject('New Contact Message from ' . $this->data['name'])
                        ->view('emails.contact_admin')
                        ->with('data', $this->data);
        } else {
            return $this->subject('Thank You for Contacting Us!')
                        ->view('emails.contact_user')
                        ->with('data', $this->data);
        }
    }
}
