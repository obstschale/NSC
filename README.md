# NSC
*Number System Converter -- an [Alfred](http://www.alfredapp.com/) extension*
* * * 

**Author:** [Hans-Helge B&uuml;rger](http://www.hanshelgebuerger.de "Hans-Helge Bürger - Webpage")  
**Date:** 12. Dezember 2012  
**Version:** v1.3  
**Licence:** [Attribution 3.0 Unported (CC BY 3.0)](http://creativecommons.org/licenses/by/3.0/ "Attribution 3.0 Unported (CC BY 3.0)")

## Quick Installation
### Download [NSC v1.3](https://github.com/obstschale/Number-System-Converter--NSC-/raw/master/nsc-v1.3.alfredextension)
Download the newest version and install it by double clicking it.

---
## Introduction

*NSC* is a little [Alfred](http://www.alfredapp.com/) extension to convert a number into another number system. I study computer science and therefore I daily deal with different number systems. The most common ones are probably `binary`, `octal`, `decimal`, and `hexadecimal` but I got tiered to calculate them by hand, calculator or a webpage. Alfred is only a key stroke away and so I started programming this extention.

## Functions

Like I mentioned above, you can convert numbers. In the first version I implemented `binary`, `decimal`, and `hexadecimal`. Now I programmed my own function to use any number system up to base 35 (Why 35? Because Z is the last letter ;) ).

## Usage

But how can I use NSC? It is really simple.

You call NSC with the keyword *nsc* and NSC needs three parameters:
<source> <destination> <number>

* source: base of given number
* destination: base of new number system
* number: your number

The following can be used as *source* or *destination*:
* 'b' for binary
* 'o' for octal
* 'd' for decimal
* 'h' for hex
* a number smaller than 36

### Examples

* `nsc d b 10` → result: 1010

* `nsc 10 2 10` → result: 1010

* `nsc h d A1B` → result: 2587

* `nsc o h 1337` → result: 2DF

---

## Changelog
### v1.3
* bug: minor bugfixes
* add: display letters if digits larger than 10

### v1.2
* add: convert to `decimal` with an own function
* add: convert from `decimal` to other number system upto base 35

### v1.1
* add: convert between `binary`, `deciaml`, and  `hexadeciaml` with PHP builtin functions

### v1.0
* first version of NSC
* add: can convert from `decimal` to `binary` and `hexadecimal` with PHP builtin functions

## Roadmap
* better function to replace digits with letters
* add funtionality to base larger than 35 (any ideas are welcome)
* display number instantly in Alfred (will probably work with Alfred 2.x)
* convert floating numbers

---
## Licensing

I'm a huge fan of *CreativeCommons* and so it's my first choice for licensing. I choose the [**CC BY 3.0**](http://creativecommons.org/licenses/by/3.0/ "Attribution 3.0 Unported (CC BY 3.0)") so you can use it for free. It's also allowed to adapt the work, for an own tutorial or a new game. But if you use it link to the tutorial.