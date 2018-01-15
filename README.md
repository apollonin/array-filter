# Array-filter

<p align="center">

[![Build Status](https://travis-ci.org/seredenko/array-filter.svg?branch=master)](https://travis-ci.org/seredenko/array-filter)
[![Latest Stable Version](https://poser.pugx.org/seredenko/array-filter/v/stable)](https://packagist.org/packages/seredenko/array-filter)
[![Total Downloads](https://poser.pugx.org/seredenko/array-filter/downloads)](https://packagist.org/packages/seredenko/array-filter)
[![License](https://poser.pugx.org/seredenko/array-filter/license)](https://packagist.org/packages/seredenko/array-filter)
</p>

Array-filter is library for filtering arrays by pytons-style. You can put your filter conditions 
in array like a key and get filtered array.


Array-filter supports any of comparison operators [==, != , >, <, >=, <=].
Also you can use one of condition operators (AND -> &&, OR -> ||)

## Installation

### With composer
`composer require seredenko/array-filter`

## Usage

**create new array-filter object and put your array for filtering**
```
$filter = new ArrayFilter($yourArray);
```

**using simple filter**
```
$filteredArray1 = $filter['name == John'];

$filteredArray2 = $filter['balance > 5'];

$filteredArray3 = $filter['suspicious != true'];
```

**using filter with condition**
```
$filteredArray1 = $filter['name == John && balance > 5'];

$filteredArray2 = $filter['balance > 5 || suspicious != true'];

$filteredArray3 = $filter['suspicious != true && balance != 0'];
```

You will get empty array if nothing doesn't match your filter