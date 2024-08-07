<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleEditForm extends Form
{
    #[Validate('required', message:'El valor es necesario')]
    #[Validate('min:4', message:'Debe contener minimo 4 caracteres')]
    public $name;


    public function resetUI(){
        $this->reset('name');
    }

    public function Save($id){
        $data=$this->validate();

        $role = Role::find($id);
        $role->update($data);
        $this->reset();
    }
}
