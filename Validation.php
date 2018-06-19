<?php

class Validation

{
   public function validatePhoneNumber($number)
   {
        if ( ( substr($number, 0, 4) === '+370' && strlen($number) === 12 ) || ($number[0] === '8' && strlen($number) === 9 ) && is_numeric($number) ){
            return TRUE;
        }
        return FALSE;
   }
}
