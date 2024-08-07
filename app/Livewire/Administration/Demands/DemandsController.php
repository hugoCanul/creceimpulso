<?php

namespace App\Livewire\Administration\Demands;

use App\Livewire\Forms\DemandsVerifyCurpForm;
use App\Models\Demand;
use Livewire\Component;
use Livewire\WithPagination;

class DemandsController extends Component
{

    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName; 

    public $pagination = 10;

    protected $queryString = ['search'];

    public DemandsVerifyCurpForm $demandsverifycurp;

    public function render()
    {
        if($this->search){
            $data = Demand::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Demand::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire..administration.demands.component',[
            'data' => $data,
        ])
        ->extends('layouts.themes.app')
        ->section('content');
    }

    public function mount(){
        $this->open = false;
        $this->search = null;
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE SOLICITUDES';
    }

    public function resetUI()
    {
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN DE SOLICITUDES';
        $this->resetValidation();
        $this->resetPage();
        $this->demandsverifycurp->open = false;
        $this->reset([ 'search', 'selected_id']);
    }

    public function Store()
    {

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Registro agregado con éxito!');
    }

    public function Editar($id)
    {
        $this->open = true;
        $demand = Demand::find($id);

        $this->roleeditform->name = $demand->name;

        $this->selected_id = $id;
    }

    public function Update($id)
    {

        $this->resetUI();
        $this->dispatch('sweet-toast', icon:'success', title:'Actualización exitosa!');
    }

    public function confirmDelete(Demand $demand)
    {
        $demand->delete();
        $this->dispatch('sweet-toast', icon:'succes', title:'Registro eliminado');
        $this->resetUI();
    }

    public function verify()
    {
        $data = $this->demandsverifycurp->validateCurp();
        
        if($data == 1)
        {
            $this->dispatch('sweet-toast', icon:'error', title:'El cliente existe en la base de datos!');
        }else if ($data == 3){
            $this->dispatch('sweet-toast', icon:'error', title:'La CURP no tiene el formato correcto!');
        }else{
            $this->dispatch('sweet-toast', icon:'success', title:'puede capturar la solicitud!');
            $this->demandsverifycurp->open = false;
            
        }
    }
}
