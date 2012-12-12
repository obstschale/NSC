<?php

/* -----------------------------------
	Script: 	Number System Converter
	Author: 	Hans-Helge Bürger
	Usage:		nsc <source> <destination> <number>
	Desc:		  Converts numbers from one into another number system
	Updated:	12.Dez.2012 
	Version:	1.3 
----------------------------------- */

init($argv[1]);

/**
 * init explodes the given parameter into an array and decides what to do. Whether to calculate or to throw an error.
 * @param  string $q string passed by Alfred
 * @return string    this is not a real return only a echo which is piped into pbcopy.
 */
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

if ( $q[0] > 35 || $q[1] > 35 ) {
	echo errorMessage(4) . "\n";
} else {

	// make sure that source and destination letters are lower case
	if ( is_string($q[0]) || is_string($q[1]) ) {
		ucfirst($q[0]);
		ucfirst($q[1]);
	}

	// Determine source type
	switch ($q[0]) {
	  case 'b': //src is binary
			$num = binary($q[1], $q[2]);
	    break;

	   case 'o': //src is octal
	   	$num = numToNumSystem( $q[1], numToDecimal( $q[0], $q[2] ) );
	   	break;
	      
	  case 'd': //src is decimal
			$num = decimal($q[1], $q[2]);
	    break;
	      
	  case 'h': //src is hexadecimal
			$num = hexadecimal($q[1], $q[2]);
	   	break;
		
		default:
			//src is not a common number system && is_numeric
			if ( is_numeric($q[0]) ) {
				
				// calculate decimal number
				$num = numToNumSystem( $q[1], numToDecimal( $q[0], $q[2] ) );
				
				// echo "Source: " . $q[2] . "\n";
				// $zahl =  numToDecimal( $q[0], $q[2] );
				// echo "Decimal: " . $zahl . "\n";
				// echo "Destination: " . numToNumSystem( $q[1],  $zahl) . "\n";

			} else {
				$num = errorMessage(1);
			}
	}

	//Return the the number 
	echo $num . "\n";
}
}

/**
 * if a 'b' is enterd as source this funtion decides how to calculate the new number
 * @param  string $des either it is a string or a integer. Base of new number system
 * @param  int $num number to convert
 * @return int      converted number
 */
function binary ($des, $num){
//Determine destination type
switch ($des) {
	case 'b': //destination is the same like source
		return $num;
		break;

	case 'o': //destination octal
		return numToNumSystem( $des, numToDecimal( 2, $num ) );
		break;

	case 'd': //destination decimal
		return bindec(trim($num));
		break;
	
	case 'h': //destination hexadecimal
		return bin2hex(trim($num));
		break;
		
	default:
		if ( is_numeric($des) ) {
			// if a number is passed as destination type
			// the number will be converted into number system
			// with this number as base
			
			return numToNumSystem( $des, numToDecimal( 2, $num ) );
		} else {
		return errorMessage(2);
	}
}
}

/**
 * if a 'd' is enterd as source this funtion decides how to calculate the new number
 * @param  string $des either it is a string or a integer. Base of new number system
 * @param  int $num number to convert
 * @return int      converted number
 */
function decimal ($des, $num){
//Determine destination type
switch ($des) {
	case 'b': //destination binary
		return decbin(trim($num));
		break;

	case 'o': //destination octal
		return numToNumSystem( $des, $num );
		break;

	case 'd': //destination is the same like source
		return $num;
		break;
	
	case 'h': //destination hexadecimal 
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

/**
 * if a 'h' is enterd as source this funtion decides how to calculate the new number
 * @param  string $des either it is a string or a integer. Base of new number system
 * @param  int $num number to convert
 * @return int      converted number
 */
function hexadecimal ($des, $num){
//Determine destination type
switch ($des) {
	case 'd': //destination binary
		return hex2bin(trim($num));
		break;

	case 'o': //destination octal
		return numToNumSystem( $des, numToDecimal( 16, $num ) );
		break;
	
	case 'd': //destination decimal
		return hexdec($num);
		break;

	case 'h': //destination is the same like source
		return $num;
		break;

	default:
		if ( is_numeric($des) ) {
			// if a number is passed as destination type
			// the number will be converted into number system
			// with this number as base
			
			return numToNumSystem( $des, numToDecimal( 16, $num ) );

		} else {
			return errorMessage(2);
	 }
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

	// If Base is a letter it will be converted into a integer
	// b = 2; o = 8; d = 10; h = 16;
	if ( !is_numeric($base) )
		$base = convertBaseToInt($base);

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

	// If Base is a letter it will be converted into a integer
	// b = 2; o = 8; d = 10; h = 16;
	if ( !is_numeric($base) ) {
		$base = convertBaseToInt($base);
	}

	// separate digits by using it as string
	// with string length we know how to calculate
	// the decimal number
	$len=strlen($number);

	for($j=0; $j < $len; $j++)
	{
	   // calculation of decimal number
	   // with power method
	   $dec += pow($base, ($len-1)-$j) * letterToDigit($number[$j]);
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

		case '3':
			return "Error 03: I don't know this letter, bro.";
			break;

		case '4':
			return "Error 04: I'm really sorry, but I cannot deal with number systems larger than base 35.";
			break;

		case '5':
			return "Error 05: I don't know this base. Please use a integer or b(inary), o(ctal), d(ecimal) or h(exadecimal) as base.";
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

/**
 * converts letter in a equivalent digit
 * @param  char $let letter to convert
 * @return int      digit
 */
function letterToDigit ( $let ) {
	if ( is_numeric($let) ) {
		return $let;
	}	else {
		$let = ucwords($let);
		switch ($let) {
			case 'A':
				return '10';
				break;
			
			case 'B':
				return '11';
				break;
			
			case 'C':
				return '12';
				break;
			
			case 'D':
				return '13';
				break;
			
			case 'E':
				return '14';
				break;
			
			case 'F':
				return '15';
				break;
			
			case 'G':
				return '16';
				break;

			case 'H':
				return '17';
				break;

			case 'I':
				return '18';
				break;

			case 'J':
				return '19';
				break;

			case 'K':
				return '20';
				break;

			case 'L':
				return '21';
				break;

			case 'M':
				return '22';
				break;

			case 'N':
				return '23';
				break;

			case 'O':
				return '24';
				break;

			case 'P':
				return '25';
				break;

			case 'Q':
				return '26';
				break;

			case 'R':
				return '27';
				break;

			case 'S':
				return '28';
				break;

			case 'T':
				return '29';
				break;

			case 'U':
				return '30';
				break;

			case 'V':
				return '31';
				break;

			case 'W':
				return '32';
				break;

			case 'X':
				return '33';
				break;

			case 'Y':
				return '34';
				break;

			case 'Z':
				return '35';
				break;

			default:
				return errorMessage(3);
				break;
		}
	}
}

/**
 * converts letters into number for common number system, like binary, octal, decimal or hexadecimal
 * @param  char $base base as letter
 * @return int       equivalent integer
 */
function convertBaseToInt ($base) {
	switch ($base) {
		case 'b':
			return 2;
			break;
		
		case 'o':
			return 8;
			break;

		case 'd':
			return 10;
			break;

		case 'h':
			return 16;
			break;

		default:
			return errorMessage(5);
			break;
	}
}

?>