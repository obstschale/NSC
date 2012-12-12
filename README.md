# NSC
*Number System Converter*
* * * 

**Author:** [Hans-Helge B&uuml;rger ](http://www.hanshelgebuerger.de "Hans-Helge Bürger - Webpage")  
**Date:** 12nd December 2012  
**Version:** v1.3  
**Licence:** [Attribution 3.0 Unported (CC BY 3.0)](http://creativecommons.org/licenses/by/3.0/ "Attribution 3.0 Unported (CC BY 3.0)")

### Introduction

*NSC* is a little Alfred extension to convert a number into another number system. I study computer science and therefore I daily deal with different number systems. The most common ones are probably *binary*, *octal*, *decimal*, and *hexadecimal* but I got tiered to calculate them by hand, calculator or a webpage. Alfred is only a key stroke away and so I started programming this extention.

### Functions

Like I mentioned above, you can convert numbers. In the first version I implemented *binary*, *decimal*, and *hex*. Now I programmed my own function to use any number system up to base 35 (**Why 35? Because Z is the last letter ;)**).

### Usage

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

nsc d b 10
result: 1010

nsc 10 2 10
result: 1010

nsc h d A1B
result: 2587

nsc o h 1337
result: 2DF

### Licensing

I'm a huge fan of *CreativeCommons* and so it's my first choice for licensing. I choose the [**CC BY 3.0**](http://creativecommons.org/licenses/by/3.0/ "Attribution 3.0 Unported (CC BY 3.0)") so you can use it for free. It's also allowed to adapt the work, for an own tutorial or a new game. But if you use it link to the tutorial.