<?php
function checkPositive($number) {
   if (!is_numeric(substr($number, 0, 1))) {
	   $sign = substr($number, 0, 1);
	   return 'before';
   }
   return 'after';
}