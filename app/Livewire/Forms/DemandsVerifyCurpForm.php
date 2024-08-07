<?php

namespace App\Livewire\Forms;

use App\Models\Demand;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DemandsVerifyCurpForm extends Form
{
    public $componentName;

    public $open=false;

    #[Validate('required',message:'Es necesario registrar una CURP')]
    public $curp;
    public $validationResult;

    public function validateCurp(){
        $this->validate();

        $validationResult = $this->validarCURP(strtoupper($this->curp));
        
        if ($validationResult){
            $demand = Demand::whereCurp($this->curp)->count();
            if ($demand > 0)
                return 1;
            else
                return 2;
        }else{
            return 3;
        }
    }

    function validarCURP($cadena) {
        $curp = mb_strtoupper($cadena, "UTF-8");
        $pattern = "/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/";
        $validacionRegex = preg_match($pattern, $curp);
        if ($validacionRegex === 0) {
            #No cumple con un formato válido
            return false;
        }
        #De aquí en adelante se verifica el dígito verificador
        $diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        $lngSuma = 0.0;
        $lngDigito = 0.0;
        $curp17 = substr($curp, 0, 17);
        for ($i = 0; $i < 17; $i++) {
            //lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
            //lngDigito = 10 - lngSuma % 10;
            $lngSuma = $lngSuma + mb_strpos($diccionario, mb_substr($curp17, $i, 1)) * (18 - $i);
        }
        $lngDigito = 10 - ($lngSuma % 10);
        if ($lngDigito == 10) {
            $digitoVerificador = 0;
        }
        $digitoVerificador = $lngDigito;
        return $digitoVerificador == $curp[17];
    }
    

    public function resetUI(){
        $this->open=false;
    }

}