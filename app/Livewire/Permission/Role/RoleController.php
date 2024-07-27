<?php

namespace App\Livewire\Permission\Role;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName, $open; 

    #[Validate('required', message:'El valor es necesario')]
    #[Validate('unique:roles,name', message:'No se puede duplicar el Rol')]
    #[Validate('min:4', message:'Debe contener minimo 4 caracteres')]
    public $name;

    public $pagination = 10;

    protected $queryString = ['search'];

    public function mount(){
        $this->open = false;
        $this->name = '';
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
        $this->name = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE ROLES';
        $this->resetValidation();
        $this->resetPage();
        $this->open = false;
        $this->reset(['name', 'search', 'selected_id']);
    }

    public function Store()
    {
        $this->validate();

        Role::create(['name' => $this->name, 'guard_name'=>'web']);

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Registro agregado con éxito!');
    }

    public function Editar($id)
    {
        $this->open = true;
        $rol = Role::find($id);

        $this->name = $rol->name;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate();

        $rol = Role::find($this->selected_id);

        $rol->update(['name' => $this->name]);

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
