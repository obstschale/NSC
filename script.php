<?php

/* -----------------------------------
	Script: 	Number System Converter
	Author: 	Hans-Helge Bürger
	Usage:		binary <source> <destination> <number>
	Desc:		Converts numbers from one into another number system
	Updated:	10.Dez.2012 
	Version:	1.1 
----------------------------------- */

init($argv[1]);

function init ($q) {
/* 
	This init function runs first and analysis all parameters
	to decide which convertion to be choosen
*/

//Break input into pieces
/*
	$q[0] = source
	$q[1] = destination
	$q[2] = number
*/
$q = explode( " ", $q );

//Determine source type
switch ($q[0]) {
    case "b": //src is binary
		$num = binary($q[1], $q[2]);
        break;
        
    case "d": //src is decimal
		$num = decimal($q[1], $q[2]);
        break;
        
    case "h": //src is hexadeciaml
		$num = hexadecimal($q[1], $q[2]);
        break;

    // @TODO: src is another number system
    
	default:
		echo "Error 01: Wrong source parameter given.";
}

//Return the the number 
echo $num;

}

function binary ($des, $num){
//Determine destination type
switch ($des) {
	case "d": //destination decimal
		return bindec(trim($num));
		break;
	
	case "h": //destination hexadecimal
		return bin2hex(trim($num));
		break;
		
	default:
		return "Error 02: Wrong destination parameter given.";
	}
}

function decimal ($des, $num){
//Determine destination type
switch ($des) {
	case "b": //destination binary
		return decbin(trim($num));
		break;
	
	case "h": //destination hexadecimal 
		return dechex(trim($num));
		break;

	default:
		if ( is_numeric($des) ) {
			// if a number is passed as destination type
			// the number will be converted into number system
			// with this number as base
			
			return numToNumSystem( $des, $num );

		} else {
			return "Error 02: Wrong destination parameter given.";
	 }
}
}

function hexadecimal ($des, $num){
//Determine destination type
switch ($des) {
	case "b": //destination binary
		return hex2bin(trim($num));
		break;
	
	case "d": //destination decimal
		return hexdec($num);
		break;

	default:
		return "Error 02: Wrong destination parameter given.";
}
}

/**
 * numToNumSystem will converte a number into a not common number system.
 * This function asumes that the number is allready a decimal number.
 * If this number is not decimal it firstly has to be converted into decimal.
 * @param  int $base   base of new number system
 * @param  float $number number to convert
 * @return int         converted number (same value but new number system)
 */
function numToNumSystem ( $base, $number ) {

	while ( $number > 1 ) {
		$convertedNumber = $number % $base . $convertedNumber;
		$number = $number / $base;	
	}

	return $convertedNumber;
}

?>