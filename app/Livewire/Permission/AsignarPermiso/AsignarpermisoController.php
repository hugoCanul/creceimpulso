<?php

namespace App\Livewire\Permission\AsignarPermiso;

use Livewire\Component;
use Livewire\WithPagination;

class AsignarpermisoController extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.permission.asignar-permiso.component');
    }
}
