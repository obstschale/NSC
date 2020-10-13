#!/usr/bin/env python

import sys
import alp

# calculate decimal number
decimal = int(sys.argv[1], 16)
# create associative array and create xml from it
decimalDic = dict(title=str(decimal), subtitle="Decimal", uid="decimal", valid=True, arg=str(decimal), icon="icons/decimal.png")
d = alp.Item(**decimalDic)


# calculate binary number
binary = bin(decimal)[2:].zfill(8)
# create associative array and create xml from it
binaryDic = dict(title=str(binary), subtitle="Binary", uid="binary", valid=True, arg=str(binary), icon="icons/binary.png")
b = alp.Item(**binaryDic)

# calculate octal number
octal = oct(decimal)[1:]
# create associative array and create xml from it
octalDic = dict(title=str(octal), subtitle="Octal", uid="octal", valid=True, arg=str(octal), icon="icons/octal.png")
o = alp.Item(**octalDic)

itemsList = [d, b, o]

# calculate negative number
tc = alp.decimal2negative(decimal)
if (tc < 0):
    # create associative array and create xml from it
    tcDic = dict(title=str(tc), subtitle="2's complement negative after trimming the zeros before the most significant bit", uid="negative", valid=True, arg=str(tc), icon="icons/decimal.png")
    t = alp.Item(**tcDic)
    itemsList += [t]

alp.feedback(itemsList)
