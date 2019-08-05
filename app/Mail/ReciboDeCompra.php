<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Venta;

class ReciboDeCompra extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $venta;
    public function __construct(Venta $venta)
    {
        $this->venta=$venta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $venta=$this->venta;
        return $this->view('mails.Recibo')->subject('Recibo de compra #NX'.$venta->created_at->format('y').$venta->created_at->format('m').($venta->id+99));
    }
}
