<?php

namespace App\Livewire\Forms;


use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleCreateForm extends Form
{
    #[Validate('required', message:'El valor es necesario')]
    #[Validate('unique:roles,name', message:'No se puede duplicar el Rol')]
    #[Validate('min:4', message:'Debe contener minimo 4 caracteres')]
    public $name;

    public function resetUI(){
        $this->reset('name');
    }

    public function Save(){
        
        $this->validate();
        Role::create(attributes:['name'=>$this->name,'guard_name'=>'web']);
    }
}
