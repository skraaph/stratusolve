<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['max'])) {
        $MaxInt = filter_input(INPUT_POST, 'max', FILTER_SANITIZE_NUMBER_INT);
    } else $MaxInt = 34;

    Define("MAX_FIBONACCI_INT", $MaxInt);
    
    run();
}

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

function run() {
    $FibonacciArr = iterator_to_array(getFibonacciInt(MAX_FIBONACCI_INT));
    $Output = json_encode($FibonacciArr);
    echo $Output;
}
?>