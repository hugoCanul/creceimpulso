<?php

namespace App\Livewire\Administration\Administradores;

use App\Models\Administrators;
use App\Models\Cities;
use App\Models\Coordinator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class AdministratorController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName, $open; 

    #[Validate('required', message:'El valor es necesario')]
    #[Validate('min:3', message:'Debe contener minimo 3 caracteres')]
    public $name;

    #[Validate('required', message:'El valor es necesario')]
    #[Validate('min:4', message:'Debe contener minimo 4 caracteres')]
    public $lastName;


    #[Validate('required', message:'El valor es necesario')]
    public $city_id;

    #[Validate('required', message:'El valor es necesario')]
    public $coordinator_id;

    #[Validate('required', message:'El valor es necesario')]
    #[Validate('min:10', message:'Debe contener minimo 10 digitos')]
    #[Validate('max:10', message:'Debe contener máximo 10 digitos')]
    #[Validate('unique:administrators,phone', message:'El numero telefonico ya esta registrado para otro usuario')]
    public $phone;

    public $pagination = 10;

    protected $queryString = ['search'];

    public function mount(){
        $this->open = false;
        $this->name = '';
        $this->lastName='';
        $this->city_id='';
        $this->coordinator_id='';
        $this->phone='';
        $this->search = null;
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE ADMINISTRADORES';
    }

    public function render()
    {
        if($this->search){
            $data = Administrators::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Administrators::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.administration.administradores.component', [
            'data' => $data,
            'ciudades'=> Cities::all(),
            'coordinadores'=> Coordinator::all(),
        ])
            ->extends('layouts.themes.app')
            ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->lastName='';
        $this->city_id='';
        $this->coordinator_id='';
        $this->phone='';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE ADMINISTRADORES';
        $this->resetValidation();
        $this->resetPage();
        $this->open = false;
        $this->reset(['name', 'search', 'selected_id']);
    }

    public function Store()
    {
        $data = $this->validate();

        Administrators::create($data);

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Registro agregado con éxito!');
    }

    public function Editar($id)
    {
        $this->open = true;
        $Admins = Administrators::find($id);

        $this->name = $Admins->name;
        $this->lastName = $Admins->lastName;
        $this->city_id = $Admins->city_id;
        $this->coordinator_id = $Admins->coorditar_id;
        $this->phone = $Admins->phone;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate();

        $Admins = Administrators::find($this->selected_id);

        $Admins->update(['name' => $this->name, 
            'lastName' =>  $this->lastName,
            'city_id' => $this->city_id,
            'coordinator_id' =>  $this->lastName,
            'phone'=>$this->phone]);

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Actualización exitosa!');
    }


    public function confirmDelete(Administrators $administrador)
    {
        $administrador->delete();
        $this->dispatch('sweet-toast', icon:'succes', title:'Registro eliminado');
        $this->resetUI();
    }
    
}
