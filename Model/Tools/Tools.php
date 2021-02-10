<?php

namespace Model\Tools;

class Tools {

    public function cnpjPadrao($dados){
        $cnpj_array = str_split($dados);
        $contador = sizeof($cnpj_array);
        $x = 0;
        $CNPJ = "";
        while($x<=$contador){
            $CNPJ .= $cnpj_array[$x];
            if($x == 1){
                $CNPJ .= ".";
            }elseif($x == 4){
                $CNPJ .= ".";
            }elseif($x == 7){
                $CNPJ .= "/";
            }elseif($x == 11){
                $CNPJ .= "-";
            }
            $x += 1;
            if($x == $contador){break;}
        }
        return $CNPJ;
    }
    
}
