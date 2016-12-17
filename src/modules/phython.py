import json
import runpy
import sys

def run():
    args = sys.argv

    if len(args) < 3:
        raise Exception('Both module name and function name are required.')

    module, function = args[1:3]
    module = runpy.run_module(module)

    if function not in module:
        raise Exception(function + ' is not defined in ' + module['__file__'])

    call(module[function])

def call(function):
    arguments = raw_input().strip()
    arguments = json.loads(arguments)
    output = function(*arguments)
    print(json.dumps(output))

run()
