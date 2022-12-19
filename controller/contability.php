<?php

class Contability {

    private $value;
    private $parcel;
    private $fees;

    public function __construct()
    {
        $this->setContability();
    }

    private function setContability()
    {
        $post = (isset($_POST))? $_POST : null;

        $newValue = $post['valor'];
        $newValue = str_replace('.', '', $newValue);
        $newValue = substr($newValue, 0, strpos($newValue, ','));

        $this->value   = $newValue;
        $this->parcel  = (int)$post['parcelas'];
        $this->fees    = (float)$post['juros'];

        $result = $this->calculateLoan();
        echo json_encode($result);
    }

    private function calculateLoan(){

        $value  = $this->value;
        $parcel = $this->parcel;
        $fees   = $this->fees;

        $result = [];
        $m = 0;

        for ($i = 0; $i < $parcel; $i++){
            $jc = $value * ($fees/100);
            $m += $jc;  
            $v = $value + $m;
            $v = (string)$this->formatValue($v);
            $t = $this->formtFees($m);
            $result[] = [$v, $t];
        }
        
        return $result;
    }

    private function formatValue($val){

        $dot    = strpos($val, '.');
        $pos   = substr($val, strpos($val, '.'), 3);
        $prev  = substr($val, 0, strpos($val, '.'));

        if ($dot) {

            if (strlen($pos) == 0)
                return $prev . '.00';
            else if (strlen($pos) == 2)
                return $prev . $pos . '0';

        } else {

            return $val . '.00';
        }

        return $prev . $pos;
    }

    private function formtFees($fees){

        $dot    = strpos($fees, '.');
        $pos    = substr($fees, strpos($fees, '.'), 3);
        $prev   = substr($fees, 0, strpos($fees, '.'));

        if ($dot){

            if (strlen($pos) == 0)
                return $prev . '.00';
            else if (strlen($pos) == 2)
                return $prev . $pos . '0';

        } else {

            return $fees . '.00';    
        }
           
        return $prev . $pos;
    }
}

new Contability;