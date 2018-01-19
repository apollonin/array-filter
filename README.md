# Array-filter

<p align="center">

[![Build Status](https://travis-ci.org/seredenko/array-filter.svg?branch=master)](https://travis-ci.org/seredenko/array-filter)
[![Latest Stable Version](https://poser.pugx.org/seredenko/array-filter/v/stable)](https://packagist.org/packages/seredenko/array-filter)
[![Total Downloads](https://poser.pugx.org/seredenko/array-filter/downloads)](https://packagist.org/packages/seredenko/array-filter)
[![License](https://poser.pugx.org/seredenko/array-filter/license)](https://packagist.org/packages/seredenko/array-filter)
</p>

Array-filter is library for filtering arrays by pytons-style. You can put your filter conditions 
in array like a key and get filtered array.


Array-filter supports any of comparison operators `[==, != , >, <, >=, <=]`.
Also you can use one of condition operators `(AND -> &&, OR -> ||)`

## Installation

### Via composer
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

**array-filter returns you a new self-object with filtered array. You can use keys chaining for 
filtering filtered result**

```
  // second key will filter result of first key

  $filteredArray = $filter['isActive == true || balance == 6.99']['suspicious == false && age < 40']
```

**If you want to get specific fields from original array or from filtered array use key, 
where write all keys, divided by ':'**

```
  $filteredArray = $filter['name == Gregory || balance == 6.99']['name:balance'];
```

**For getting results of filtering in new array - use one of two methods or cast object to array**

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