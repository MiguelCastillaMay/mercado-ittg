<?php

namespace App\Observers;

use App\Models\Categoria;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class CategoriaObserver
{
    protected $usuario = null;

    public function __construct() {
        $user = Auth::User();
        if (is_null($user))
            $this->usuario = 'Anonimo';
        else
            $this->usuario = $user->nombre;
    }

    /**
     * Handle the Categoria "created" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function created(Categoria $categoria)
    {
        $registro = Bitacora::create([
            'quien' => $this->usuario,
            'accion' => 'Creó categoría',
            'que' => $categoria->toJson()
        ]);
    }

    /**
     * Handle the Categoria "updated" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function updated(Categoria $categoria)
    {
        $registro = Bitacora::create([
            'quien' => $this->usuario,
            'accion' => 'Modificó categoría',
            'que' => $categoria->toJson()
        ]);
    }

    /**
     * Handle the Categoria "deleted" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function deleted(Categoria $categoria)
    {
        $registro = Bitacora::create([
            'quien' => $this->usuario,
            'accion' => 'Eliminó categoría',
            'que' => $categoria->toJson()
        ]);
    }

    /**
     * Handle the Categoria "restored" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function restored(Categoria $categoria)
    {
        //
    }

    /**
     * Handle the Categoria "force deleted" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function forceDeleted(Categoria $categoria)
    {
        //
    }
}
