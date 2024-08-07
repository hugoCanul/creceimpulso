<?php

namespace App\Livewire\Permission\Role;

use App\Livewire\Forms\RoleCreateForm;
use App\Livewire\Forms\RoleEditForm;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName, $open; 

    public RoleCreateForm $rolecreateform;

    public RoleEditForm $roleeditform;

    public $pagination = 10;

    protected $queryString = ['search'];

    public function mount(){
        $this->open = false;
        $this->search = null;
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE ROLES';
    }

    public function render()
    {
        if($this->search){
            $data = Role::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Role::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.permission.role.component', [
            'data' => $data,
        ])
            ->extends('layouts.themes.app')
            ->section('content');
    }

    public function resetUI()
    {
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE ROLES';
        $this->rolecreateform->resetUI();
        $this->roleeditform->resetUI();
        $this->resetValidation();
        $this->resetPage();
        $this->open = false;
        $this->reset([ 'search', 'selected_id']);
    }

    public function Store()
    {

        $this->rolecreateform->Save();
        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Registro agregado con éxito!');
    }

    public function Editar($id)
    {
        $this->open = true;
        $rol = Role::find($id);

        $this->roleeditform->name = $rol->name;

        $this->selected_id = $id;
    }

    public function Update($id)
    {

        $this->roleeditform->Save($id);
        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Actualización exitosa!');
    }


    public function confirmDelete(Role $role)
    {
        $role->delete();
        $this->dispatch('sweet-toast', icon:'succes', title:'Registro eliminado');
        $this->resetUI();
    }
}
