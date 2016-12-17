def sort(array, reverse=False):
    array.sort()
    if reverse:
        array.reverse()
    return array

def reverse(value):
    return value[::-1]
