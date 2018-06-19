<?php

class Validation

{
   public function validatePhoneNumber($number)
   {
        if ( substr($number, 0, 4) === '+370' && strlen($number) === 12 && is_numeric($number) || ($number[0] === '86' && strlen($number) === 9 && is_numeric($number)) ){
            return TRUE;
        }
        return FALSE;
   }

   public function validateEmail($email)
   {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        }
        return TRUE;
   }
}
