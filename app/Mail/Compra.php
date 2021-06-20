<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Producto;
use App\Models\Usuario;

class Compra extends Mailable
{
    use Queueable, SerializesModels;

    protected $producto, $usuario, $cantidad, $total;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Producto $producto, Usuario $usuario, $cantidad, $total)
    {
        $this->producto = $producto;
        $this->usuario = $usuario;
        $this->cantidad = $cantidad;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('email@tiendaficticia.test')->view('emails.notificacion-compra')->with([
            'nombre' => $this->usuario->nombre,
            'correo' => $this->usuario->correo,
            'producto' => $this->producto->nombre,
            'cantidad' => $this->cantidad,
            'precio' => $this->producto->precio,
            'total' => $this->total,
        ]);
    }
}
