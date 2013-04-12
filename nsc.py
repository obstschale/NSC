#!/usr/bin/python
""" -----------------------------------
	Script: 	Number System Converter
	Author: 	Hans-Helge Buerger
	Usage:		nsc <source> <number>
	Desc:		  Converts numbers from one into another number system
	Updated:	09.April 2013
	Version:	2.0 
----------------------------------- """

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