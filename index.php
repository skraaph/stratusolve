<?php

// Task: Create a function "addAll()" that will take an array as input parameter.
// The function will sum all the elements in the array and then remove the first element of the array.
// The function should repeat this until the array is empty and then return the total.
// For example: For the array [1,1,1,1,1], the result should be 15 -> 5+4+3+2+1=15
// Optimize your solution as far as possible.

// 1. Implement the solution as a loop
// 2. Implement the solution using recursive function

function addAll($Array) {
    $ArraySumInt = 0;
    $ArraySizeInt = count($Array);
    for ($i=0; $i < $ArraySizeInt; $i++) {
        $ArraySumInt += array_sum($Array);
        array_shift($Array);
    }
    return $ArraySumInt;
}

function addAllRecursive($Array) {
    $ArraySumInt = array_sum($Array);
    array_shift($Array);
    return (count($Array) > 0) ? $ArraySumInt + addAllRecursive($Array) : $ArraySumInt;
}
$Array = [1,1,1,1,];  //5+4+3+2+1=15

echo addAll($Array) . '<br>';
echo addAllRecursive($Array) . '<br>';
?>