#!/usr/bin/python
""" -----------------------------------
	Script: 	Number System Converter
	Author: 	Hans-Helge Buerger
	Usage:		nsc <source> <number>
	Desc:		  Converts numbers from one into another number system
	Updated:	09.April 2013
	Version:	2.0 
----------------------------------- """

import sys
from lxml import etree

"""
createXML expects and associative array to generate XML out of it
It has to be done to display the converted numbers live in Alfred 2
"""
def createXML(data):
		item = etree.Element("item", uid=data['uid'], arg=data['arg'])

		title = etree.SubElement(item, "title")
		title.text = data['title']

		subtitle = etree.SubElement(item, "subtitle")
		subtitle.text = data['subtitle']

		return item

# create items element for Alfred
items = etree.Element("items")

# calculate binary number
binary = bin(int(sys.argv[1]))[2:]
# create associative array and create xml from it
b = {'uid':"binary", 'arg':binary, 'title':binary, 'subtitle':"Binary"}
item = createXML(b)
# append new item to items
items.append(item)

# calculate octal number
octal = oct(int(sys.argv[1]))[1:]
# create associative array and create xml from it
d = {'uid':"octal", 'arg':octal, 'title':octal, 'subtitle':"Octal"}
item = createXML(d)
# append new item to items
items.append(item)


# calculate hex number
hexadec = hex(int(sys.argv[1]))[2:]
# create associative array and create xml from it
h = {'uid':"hexadec", 'arg':hexadec, 'title':hexadec, 'subtitle':"Hexdecimal"}
item = createXML(h)
# append new item to items
items.append(item)

print (etree.tostring(items, pretty_print=True, xml_declaration=True))