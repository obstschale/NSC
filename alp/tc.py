def decimal2negative(n):
    """
        We convert a decimal number into a negative based on the 2's complement.
        As an example for an arbitrary decimal larger than 1:

           0101         (binary for decimal 5)
        -> 101          (trim the zeros before the most significant bit)
        -> -(2^2)+2^0   (convert binary into decimal under the 2's complment principle)
        -> -3           (result)
    """
    if (n <= 1):
        return 0

    nn = n
    bias = 1
    msb = 0
    n = int(n / 2)

    while (n > 0):
        n = int(n / 2)
        msb += 1
        bias *= 2

    return (((1 << msb) - 1) & nn) - bias

