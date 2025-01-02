# algorithms-modulus11

Modulus11 algorithm implementation for PHP

![Tests](https://github.com/tervis/algorithms-modulus11/workflows/Tests/badge.svg)


## Installation
```bash
composer require tervis/algorithms-modulus11
```


### Usage
```php
use Tervis\Algorithms\Modulus11;
```


#### Factors
The standard factors for Modulus11 calculations are [2,3,4,5,6,7], looped. In some cases other factors are used.

If your implementation requires custom factors, simply supply them as a second argument to any method.