# Array-filter

<p align="center">

[![Build Status](https://travis-ci.org/seredenko/array-filter.svg?branch=master)](https://travis-ci.org/seredenko/array-filter)
[![Latest Stable Version](https://poser.pugx.org/seredenko/array-filter/v/stable)](https://packagist.org/packages/seredenko/array-filter)
[![Total Downloads](https://poser.pugx.org/seredenko/array-filter/downloads)](https://packagist.org/packages/seredenko/array-filter)
[![License](https://poser.pugx.org/seredenko/array-filter/license)](https://packagist.org/packages/seredenko/array-filter)
</p>

Array-filter is library for filtering arrays in [python-way](https://www.python.org/dev/peps/pep-0020/). You are able to pass your conditions as array index and get filtered array.


Array-filter supports any of comparison operators `[==, != , >, <, >=, <=]`.
Also you can use one of condition operators `(AND -> &&, OR -> ||)`

## Installation

### Via composer
`composer require seredenko/array-filter`

## Usage

**create new array-filter object and put your array for filtering**
```
  $yourArray = [
    0 => ['name' => 'John', 'balance' => 1.00, 'isActive' => true],
    1 => ['name' => 'Mike', 'balance' => 10.00, 'isActive' => true],
    2 => ['name' => 'Gregor', 'balance' => 100.00, 'isActive' => false],
    ...
  ];


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

**array-filter returns a new self-object with filtered array. You can use keys chaining for filtering filtered result**

```
  // second key will filter result of first key

  $filteredArray = $filter['isActive == true || balance == 6.99']['suspicious == false && age < 40']
```

**If you want to get specific fields from original array or from filtered array, pass string with desired fields, divided by ':'**

```
  $filteredArray = $filter['name == Gregory || balance == 6.99']['name:balance'];
```

**If you want to get filtered result as normal php array, you could get it via methods or cast to array excplicitly**

```
  // return filtered result with fresh keys, from 0 to end of array
  $result = $filteredArray->array_values();
  
  // return filtered result with saving keys from original array
  $result = $filteredArray->getArrayCopy();
  
  // cast object to array
  $result = (array) $filteredArray;
```

**Set new value for one of fields in filtered array**
```
  $filteredArray = $filter['name == Gregory || balance == 6.99']['name:balance'];
  $filteredArray['balance'] = 0;
```

**You can use array-filter object like a normal array in loops**

```
  foreach($filteredArray as $value)
  {
    print_r($value);
  }
``` 