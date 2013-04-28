#!/usr/bin/env python

import sys
from lxml import etree
from nsc import createXML

# create items element for Alfred
items = etree.Element("items")

# calculate decimal number
decimal = int(sys.argv[1], 2)
# create associative array and create xml from it
d = {'uid':"decimal", 'arg':str(decimal), 'title':str(decimal), 'subtitle':"Decimal", 'icon':'icons/decimal.png'}
item = createXML(d)
# append new item to items
items.append(item)


# calculate octal number
octal = oct(decimal)[1:]
# create associative array and create xml from it
d = {'uid':"octal", 'arg':octal, 'title':octal, 'subtitle':"Octal", 'icon':'icons/octal.png'}
item = createXML(d)
# append new item to items
items.append(item)


# calculate hex number
hexadec = hex(decimal)[2:]
# create associative array and create xml from it
h = {'uid':"hexadec", 'arg':hexadec, 'title':hexadec, 'subtitle':"Hexdecimal", 'icon':'icons/hex.png'}
item = createXML(h)
# append new item to items
items.append(item)

print (etree.tostring(items, pretty_print=True, xml_declaration=True))
