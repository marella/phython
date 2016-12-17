# Phython

[![Coverage Status](https://coveralls.io/repos/github/marella/phython/badge.svg?branch=master)](https://coveralls.io/github/marella/phython?branch=master)
[![Build Status](https://travis-ci.org/marella/phython.svg?branch=master)](https://travis-ci.org/marella/phython)
[![StyleCI](https://styleci.io/repos/76745760/shield?style=flat)](https://styleci.io/repos/76745760)
[![Latest Stable Version](https://poser.pugx.org/marella/phython/v/stable)](https://packagist.org/packages/marella/phython) [![Total Downloads](https://poser.pugx.org/marella/phython/downloads)](https://packagist.org/packages/marella/phython) [![Latest Unstable Version](https://poser.pugx.org/marella/phython/v/unstable)](https://packagist.org/packages/marella/phython) [![License](https://poser.pugx.org/marella/phython/license)](https://packagist.org/packages/marella/phython)

Call Python modules and functions from PHP.

### Quick Usage

```sh
composer require marella/phython
```

```php
<?php

require 'vendor/autoload.php';

use Phython\Python;

// Example: sort an array using python
$array = [5, 3, 1, 2, 4];

// setup
$python = new Python('/path/to/your/python/modules/directory');
$sort = $python->from('array')->import('sort');

// call python function and get its return value
$sorted = $sort($array); // [1, 2, 3, 4, 5]

// multiple arguments
$reversed = $sort($array, /* reverse */ true); // [5, 4, 3, 2, 1]

// asynchronous call
$process = $sort->async($array); // background python process object
// do other stuff
$sorted = $process->output(); // [1, 2, 3, 4, 5] (waits till python function returns)
```

where `array.py` contains `sort` function:
```py
def sort(array, reverse=False):
    array.sort()
    if reverse:
        array.reverse()
    return array
```

### Documentation
See the **[wiki]** for more details and documentation.

### Contributing
See [contributing guidelines] before creating issues or pull requests.

### License
Open-source software released under [the MIT license][license].

[wiki]: https://github.com/marella/phython/wiki
[contributing guidelines]: /.github/CONTRIBUTING.md
[license]: /LICENSE
