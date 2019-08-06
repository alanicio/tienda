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
    public $venta,$nonex;
    public function __construct(Venta $venta,$nonex=null)
    {
        $this->venta=$venta;
        $this->nonex=$nonex;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $venta=$this->venta;
        if($this->nonex)
        {
            return $this->view('mails.Recibo')->subject('SEGUIMIENTO A PEDIDO #NX'.$venta->created_at->format('y').$venta->created_at->format('m').($venta->id+99));
        }
        else
        {
            return $this->view('mails.Recibo')->subject('Recibo de compra #NX'.$venta->created_at->format('y').$venta->created_at->format('m').($venta->id+99));
        }
            
    }
}
