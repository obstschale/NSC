#!/usr/bin/python

import sys
from lxml import etree
from nsc import createXML

# create items element for Alfred
items = etree.Element("items")

# calculate decimal number
decimal = int(sys.argv[1], 8)
# create associative array and create xml from it
d = {'uid':"decimal", 'arg':str(decimal), 'title':str(decimal), 'subtitle':"Decimal"}
item = createXML(d)
# append new item to items
items.append(item)


# calculate binary number
binary = bin(decimal)[2:]
# create associative array and create xml from it
b = {'uid':"binary", 'arg':binary, 'title':binary, 'subtitle':"Binary"}
item = createXML(b)
# append new item to items
items.append(item)


# calculate hex number
hexadec = hex(decimal)[2:]
# create associative array and create xml from it
h = {'uid':"hexadec", 'arg':hexadec, 'title':hexadec, 'subtitle':"Hexdecimal"}
item = createXML(h)
# append new item to items
items.append(item)

print (etree.tostring(items, pretty_print=True, xml_declaration=True))