<?php

namespace App\Livewire\Administration\Rates;

use App\Models\Cities;
use App\Models\Rates;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class RatesController extends Component
{
    use WithPagination;
    public $columns =['id' => 'ID', 'name'=>'NOMBRES', 'cicle'=>'CICLOS', 'minamount'=>'MINIMO', 'maxamount'=>'MÁXIMO', 'rate'=>'TAZA', 'cities.name'=>'CIUDAD'];

    public $displayColumns =['id', 'name', 'cicle', 'minamount', 'maxamount', 'rate', 'cities.name'];

    public $headers =['ID','NOMBRES','CICLOS','MINIMO','MÁXIMO','TAZA','CIUDAD'];



    public $search, $selected_id, $pageTitle, $componentName, $open; 

    #[Validate('required', message:'El valor es necesario')]
    #[Validate('unique:roles,name', message:'No se puede duplicar el Rol')]
    #[Validate('min:4', message:'Debe contener minimo 4 caracteres')]
    public $name;
    
    #[Validate('required', message:'El valor es necesario')]
    public $cicle;
    
    #[Validate('required', message:'El valor es necesario')]
    public $minamount;
    
    #[Validate('required', message:'El valor es necesario')]
    public $maxamount; 
    
    #[Validate('required', message:'El valor es necesario')]
    public $rate;
    
    #[Validate('required', message:'El valor es necesario')]
    public $cities_id;

    public $pagination = 10;

    protected $queryString = ['search'];

    public function mount(){
        $this->open = false;
        $this->name = '';
        $this->cicle = '';
        $this->minamount = '';
        $this->maxamount = '';
        $this->rate = '';
        $this->cities_id = '';
        $this->search = null;
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE TAZAS';
    }

    public function render()
    {
        if($this->search){
            $rows = Rates::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $rows = Rates::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.administration.rates.component', [
            'headers' => $this->headers,
            'rows' => $rows,
            'displayColumns' => $this->displayColumns,
            'cities' => Cities::all(),
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
        $this->componentName = 'SECCIÓN DE TAZAS';
        $this->resetValidation();
        $this->resetPage();
        $this->open = false;
        $this->reset(['name', 'cicle','minamount','maxamount','rate','cities_id']);
    }

    public function Store()
    {
        $data = $this->validate();

        Rates::create($data);//['name' => $this->name, 'cicle' => $this->cicle,'miamount' => $this->minamount,'maxamount' => $this->maxamount,'rate' => $this->rate,'city_id' => $this->city_id]);

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Registro agregado con éxito!');
    }

    public function Editar($id)
    {
        $this->open = true;
        $rate = Rates::find($id);

        $this->name = $rate->name;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate();

        $rate = Rates::find($this->selected_id);

        $rate->update(['name' => $this->name]);

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Actualización exitosa!');
    }


    public function confirmDelete(Rates $rate)
    {
        $rate->delete();
        $this->dispatch('sweet-toast', icon:'succes', title:'Registro eliminado');
        $this->resetUI();
    }
}

