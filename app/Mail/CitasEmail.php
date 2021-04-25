<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CitasEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $payload;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email', [
            'nombre_completo' => $this->payload['nombre_completo'],
            'fecha' => $this->payload['fecha'],
            'hora' => $this->payload['hora'],
            'medico' => $this->payload['medico']
        ])->subject('Recordatorio Cita');
    }
}
