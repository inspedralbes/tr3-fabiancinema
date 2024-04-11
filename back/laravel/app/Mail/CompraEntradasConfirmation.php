<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompraEntradasConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $entradas;

    public function __construct($entradas)
    {
        $this->entradas = $entradas;
    }

    public function build()
    {
        return $this->view('emails.CompraEntradasConfirmation')
            ->with(['entradas' => $this->entradas]);
    }
}
