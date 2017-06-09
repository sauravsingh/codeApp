<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function dateFormatConvert($var){
	return date("d-M-Y", strtotime($var));
}

function ifBlankData($var){
	return $var == 0 ? '-' : $var;
}