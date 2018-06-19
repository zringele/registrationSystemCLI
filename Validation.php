<?php

class Validation

{
   public function validatePhoneNumber($number)
   {
        if ( ( substr($number, 0, 4) === '+370' && strlen($number) === 12 && is_numeric($number) ) || ($number[0] === '86' && strlen($number) === 9 && is_numeric($number)) ){
            
            return TRUE;
        }
        var_dump(substr($number, 0, 4));
        return FALSE;
   }

}
