#!/usr/bin/env python

""" Arguments
	sys.argv[0] = filename
	sys.argv[1] = number
	sys.argv[2] = source
	sys.argv[3] = destination
"""

import sys
import alp
import string
digs = string.digits + string.lowercase


def int2base(x, base):
  if x < 0: sign = -1
  elif x==0: return '0'
  else: sign = 1
  x *= sign
  digits = []
  while x:
    digits.append(digs[x % base])
    x /= base
  if sign < 0:
    digits.append('-')
  digits.reverse()
  return ''.join(digits)


if (len(sys.argv) == 4 and sys.argv[3] != "1"):
	# calculate integer first
	decimal = int(sys.argv[1], int(sys.argv[2]))
	# create dictionary to create xml from it
	decimalDic = dict(title=str(decimal), subtitle="Decimal", uid="decimal", valid=True, arg=str(decimal), icon="icons/decimal.png")
	d = alp.Item(**decimalDic)

	# calculate new number
	conv = int2base(decimal, int(sys.argv[3]))
	# create dictionary to create xml from it
	convertDic = dict(title=conv, subtitle="Number to base " + str(sys.argv[3]), uid="conv", valid=True, arg=conv)
	c = alp.Item(**convertDic)

	itemsList = [d, c]
	alp.feedback(itemsList)

else:
	if (int(sys.argv[3]) == 1):
		errorDic = dict(title="Base 1 makes no sense", subtitle="", uid="error", valid=False, arg="error")
		error = alp.Item(**errorDic)
		alp.feedback(error)
	else:
		errorDic = dict(title="Make sure to pass 3 numbers", subtitle="for help type \"nsc help\"", uid="error", valid=False, arg="error")
		error = alp.Item(**errorDic)
		alp.feedback(error)