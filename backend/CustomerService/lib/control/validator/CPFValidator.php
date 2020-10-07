<?php


class CPFValidator implements Validator{

    public function __construct(){
    }

    public function throwException(){
        throw new Exception("CPF is invalid!");
    }

    public function validate($field, $value)
    {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $value );
        
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            $this->throwException();
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $value)) {
            $this->throwException();
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $this->throwException();
            }
        }
    }

}