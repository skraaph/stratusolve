<?php

// Task: Write a program that will start at 0 and output the fibonacci sequence up to 34

// 1. Implement the solution as a loop
// 2. Implement the solution using a recursive function

// Task 5:

// Modify your Foundation Task 2 (https://trello.com/c/rXQogHiZ) result to do the following:

// Your php script should accept a POST variable that will serve as the maximum number for the Fibonacci sequence.
// Create a new html file that will have an input box where the user can specify the maximum number for the Fibonacci sequence.
// Add a button to the html file that will, when clicked take the user input and post it (using javascript) to the php script and then output the result on the screen

Define("MAX_FIBONACCI_INT", 34);

function printFibonacciLoop($MaxInt) {
    $FirstInt = 0;
    $SecondInt = 1;
    $FibonacciInt = 0;

    while ($FibonacciInt <= $MaxInt)
    {
        echo $FibonacciInt . ' ';
        $FibonacciInt = $FirstInt + $SecondInt;
        $SecondInt = $FirstInt;
        $FirstInt = $FibonacciInt;
    }

    return;
}

function printFibonacciRecursive($MaxInt, $FirstInt_=0, $SecondInt_=1, $FibonacciInt_=0) {
    $FirstInt = $FirstInt_;
    $SecondInt = $SecondInt_;
    $FibonacciInt = $FibonacciInt_;
    
    echo $FibonacciInt . ' ';

    $FibonacciInt = $FirstInt + $SecondInt;
    $SecondInt = $FirstInt;
    $FirstInt = $FibonacciInt;

    return ($FibonacciInt <= $MaxInt) ? printFibonacciRecursive($MaxInt, $FirstInt, $SecondInt, $FibonacciInt) : 0;
}

// Using generator
function getFibonacciInt($MaxInt) {
    $FirstInt = 0;
    $SecondInt = 1;
    $FibonacciInt = 0;
    while ($FibonacciInt <= $MaxInt)
    {
        yield $FibonacciInt;
        $FibonacciInt = $FirstInt + $SecondInt;
        $SecondInt = $FirstInt;
        $FirstInt = $FibonacciInt;
    }
}

function printFibonacciGenerator($MaxInt) {
    $FibonacciGenerator = getFibonacciInt($MaxInt);
    foreach ($FibonacciGenerator as $key => $value) {
        echo $value . ' ';
    }
}

// printFibonacciLoop(MAX_FIBONACCI_INT);
// echo '</br>';
// printFibonacciRecursive(MAX_FIBONACCI_INT);
// echo '</br>';
// printFibonacciGenerator(MAX_FIBONACCI_INT);
?>

<?php include('index.html'); ?>