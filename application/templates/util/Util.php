<?php

namespace Util;

class Util
{
    
    static function getEstados()
    {
        return array("AC" => "Acre", "AL" => "Alagoas", "AM" => "Amazonas", "AP" => "Amapá", "BA" => "Bahia", "CE" => "Ceará",
                    "DF" => "Distrito Federal", "ES" => "Espírito Santo", "GO" => "Goiás", "MA" => "Maranhão", "MG" => "Minas Gerais",
                    "MS" => "Mato Grosso do Sul", "MT" => "Mato Grosso", "PA" => "Pará", "PB" => "Parabíba", "PE" => "Pernambuco", "PI" => "Piauí",
                    "PR" => "Paraná", "RJ" => "Rio de Janeiro", "RN" => "Rio Grande do Norte", "RO" => "Rondônia", "RR" => "Rorraima",
                    "RS" => "Rio Grande do Sul", "SC" => "Santa Catarina", "SE" => "Sergipe", "SP" => "São Paulo", "TO" => "Tocantins"
        );
    }
    
    static function getMeses()
    {
         return array(1=>"JAN",2=>"FEV",3=>"MAR",4=>"ABR",5=>"MAI",6=>"JUN",7=>"JUL",8=>"AGO",9=>"SET",10=>"OUT",11=>"NOV",12=>"DEZ");   
    }
    
    
    static function createSelect($options,$selectOption=false,$selectedValue=null){
        if($selectOption)
            $select =  "<option value=''>- Selecione -</option>";
        foreach ($options as $key => $val){
            $select .= '<option value ="'.$key.'"'.((($selectedValue !== null)&&($selectedValue !== ""))?(($selectedValue == $key)?'selected':''):'').'>'.ucwords(utf8_decode($val)).'</option>';
        }
        return $select;
    }
     
    static function createDinamicSelect($list,$attLabel,$attValue=false,$selectOption=false,$defaultValue=null)
    {
        if($selectOption)
            $options =  "<option value=''>- Selecione -</option>";
        foreach ($list as $obj){
            if(is_array($attLabel))
            for ($i=0;$i<count($attLabel);$i++)
                $strLabel .= "\$obj->get".$attLabel[$i]."()".(($i == count($attLabel)-1)?'':'." - ".');
            else
                $strLabel = "\$obj->get".$attLabel."()";
             
            eval("\$strValue = \$obj->get".(($attValue)?$attValue:$attLabel)."();");
            eval("\$strLabel = $strLabel;");
            $options .= "<option value='".$strValue."'".((($defaultValue !== "")&&($defaultValue !== null))?(($strValue == $defaultValue)?"selected ":""):'')." >".
            $strLabel."</option>\n";
            $strLabel = $strValue = '';
        }
        return $options;
    }
    
    
}