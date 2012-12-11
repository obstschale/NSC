<?php

/* -----------------------------------
	Script: 	Number System Converter
	Author: 	Hans-Helge Bürger
	Usage:		nsc <source> <destination> <number>
	Desc:		  Converts numbers from one into another number system
	Updated:	10.Dez.2012 
	Version:	1.2 
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
      
  case "h": //src is hexadecimal
		$num = hexadecimal($q[1], $q[2]);
   	break;

	default:
		//src is not a common number system && is_numeric
		if ( is_numeric($q[0]) ) {
			
			// calculate decimal number
			// echo var_dump($q);
			echo "Source: " . $q[2] . "\n";
			$zahl =  numToDecimal( $q[0], $q[2] );
			echo "Decimal: " . $zahl . "\n";
			echo "Destination: " . numToNumSystem( $q[1],  $zahl) . "\n";

		} else {
			return errorMessage(1);
		}
}

//Return the the number 
echo $num . "\n";

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
		return errorMessage(2);
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
			return errorMessage(2);
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
		return errorMessage(2);
}
}

/**
 * numToNumSystem convertes a number into a not common number system.
 * This function asumes that the number is allready a decimal number.
 * If this number is not decimal it firstly has to be converted into decimal.
 * @param  int $base   base of new number system
 * @param  int $number number to convert
 * @return int         converted number (same value but new number system)
 */
function numToNumSystem ( $base, $number ) {

	while ( $number > 1 ) {
		$convertedNumber = digitToLetter($number % $base) . $convertedNumber;
		$number          = $number / $base;	
	}

	return $convertedNumber;
}

/**
 * numToDecimal converts any number into decimal number system.
 * @param  int $base   base of given number
 * @param  int $number number to convert
 * @return int         number as decimal number
 */
function numToDecimal ( $base, $number ) {
	// separate digits by using it as string
	// with string length we know how to calculate
	// the decimal number
	$len=strlen($number);

	for($j=0; $j < $len; $j++)
	{
	   // calculation of decimal number
	   // with power method
	   $dec += pow($base, ($len-1)-$j) * $number[$j];
	}
	
	return $dec;
}


/**
 * This function takes a number and returns an error message
 * @param  int $errNum 	number of error message
 * @return string      	error message
 */
function errorMessage ( $errNum ) {
	switch ($errNum) {
		case '1':
			return "Error 01: Wrong source parameter given.";
			break;

		case '2':
			return "Error 02: Wrong destination parameter given.";
			break;
		
		default:
			return "Don't mess with the Zoan!";
			break;
	}
}

/**
 * checks if digit is greater than 9. If this is true it replaces the digit with a letter
 * @param  int $dig digit to check
 * @return string      either a number or a letter
 */
function digitToLetter ( $dig ) {
	if ( $dig < 10 || $dig > 36) {
		return $dig;
	}	else {
		switch ($dig) {
			case '10':
				return 'A';
				break;
			
			case '11':
				return 'B';
				break;
			
			case '12':
				return 'C';
				break;
			
			case '13':
				return 'D';
				break;
			
			case '14':
				return 'E';
				break;
			
			case '15':
				return 'F';
				break;
			
			case '16':
				return 'G';
				break;

			case '17':
				return 'H';
				break;

			case '18':
				return 'I';
				break;

			case '19':
				return 'J';
				break;

			case '20':
				return 'K';
				break;

			case '21':
				return 'L';
				break;

			case '22':
				return 'M';
				break;

			case '23':
				return 'N';
				break;

			case '24':
				return 'O';
				break;

			case '25':
				return 'P';
				break;

			case '26':
				return 'Q';
				break;

			case '27':
				return 'R';
				break;

			case '28':
				return 'S';
				break;

			case '29':
				return 'T';
				break;

			case '30':
				return 'U';
				break;

			case '31':
				return 'V';
				break;

			case '32':
				return 'W';
				break;

			case '33':
				return 'X';
				break;

			case '34':
				return 'Y';
				break;

			case '35':
				return 'Z';
				break;

			default:
				return $dig;
				break;
		}
	}
	
}

?>