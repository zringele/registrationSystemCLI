<?php

class Validation

{
   public function validatePhoneNumber($number)
   {
       if (substr($number, 0, 5) === '+3706' && strlen($number) === 12 && is_numeric($number) ){
            return 'MobLT';
       }
       if (substr($number, 0, 2) === '86' && strlen($number) === 9 && is_numeric($number) ){
            return 'MobLT';
       }
   }
}
