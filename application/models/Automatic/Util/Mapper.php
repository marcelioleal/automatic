<?php

namespace Automatic\Util;

class Mapper
{    
    
    public static function isPKSequence($class, $fieldName)
    {
        $sequence = false;
        if( ($class->isIdentifier($fieldName)) && (!$class->isIdentifierNatural($fieldName)) )
            $sequence = true;
        return $sequence;
    }
    
}