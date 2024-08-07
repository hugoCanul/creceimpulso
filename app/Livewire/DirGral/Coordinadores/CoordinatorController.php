<?php

namespace App\Livewire\DirGral\Coordinadores;

use App\Models\Cities;
use App\Models\Coordinator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class CoordinatorController extends Component
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
    #[Validate('min:10', message:'Debe contener minimo 10 digitos')]
    #[Validate('max:10', message:'Debe contener máximo 10 digitos')]
    public $phone;



    public $pagination = 10;

    protected $queryString = ['search'];

    public function mount(){
        $this->open = false;
        $this->name = '';
        $this->lastName='';
        $this->city_id='';
        $this->phone='';
        $this->search = null;
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE COORDINADORES';
    }

    public function render()
    {
        if($this->search){
            $data = Coordinator::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Coordinator::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.dirgral.coordinadores.component', [
            'data' => $data,
            'ciudades'=> Cities::all(),
        ])
            ->extends('layouts.themes.app')
            ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->lastName='';
        $this->city_id='';
        $this->phone='';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE COORDINADORES';
        $this->resetValidation();
        $this->resetPage();
        $this->open = false;
        $this->reset(['name', 'search', 'selected_id']);
    }

    public function Store()
    {
        $this->validate();

        Coordinator::create([
            'name' => $this->name, 
            'lastName' =>  $this->lastName,
            'city_id' => $this->city_id,
            'phone'=>$this->phone
    ]);

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Registro agregado con éxito!');
    }

    public function Editar($id)
    {
        $this->open = true;
        $Cordi = Coordinator::find($id);

        $this->name = $Cordi->name;
        $this->lastName = $Cordi->lastName;
        $this->city_id = $Cordi->city_id;
        $this->phone = $Cordi->phone;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate();

        $Cordi = Coordinator::find($this->selected_id);

        $Cordi->update(['name' => $this->name, 
            'lastName' =>  $this->lastName,
            'city_id' => $this->city_id,
            'phone'=>$this->phone]);

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Actualización exitosa!');
    }


    public function confirmDelete(Coordinator $coordinator)
    {
        $coordinator->delete();
        $this->dispatch('sweet-toast', icon:'succes', title:'Registro eliminado');
        $this->resetUI();
    }
}
