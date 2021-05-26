<?php

namespace App\Listeners;

use App\Events\Respuesta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificarRespuesta
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Respuesta  $event
     * @return void
     */
    public function handle(Respuesta $event)
    {
        //
    }
}
