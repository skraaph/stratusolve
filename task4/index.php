<?php

// Task:
// Implement a groupByOwners function that:
// Accepts an associative array containing the item owner name for each item.
// Returns an associative array containing an array of items for each owner name, in any order.
// For example, for associative array ["Baseball Bat" => "John", "Golf ball" => "Stan", "Tennis Racket" => "John"]
// the groupByOwners function should return
// {
//     "John":["Baseball Bat","Tennis Racket"],
//     "Stan":["Golf ball"]
// }

class ItemOwners {
    public static function groupByOwners($ItemsArr) {
        $ItemsArrOwner = array();
        foreach ($ItemsArr as $key => $value) {
            $ItemsArrOwner[$value][] = $key;
        }
        return $ItemsArrOwner;
    }
}

$ItemsArr = array(
    "Baseball Bat" => "John",
    "Golf ball" => "Stan",
    "Tennis Racket" => "John"
);
echo json_encode(ItemOwners::groupByOwners($ItemsArr));

?>