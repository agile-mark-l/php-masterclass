<?php

print "<h1>Hello world!</h1>";

$fruit = ["Apple", "Orange", "Lemon", "Banana", "Kiwi", "Avocado", "Elderberry"];

echo "<h2>Print all fruit with numbers:</h2>";

$i = 0;

foreach($fruit as $f) {
    print "$i: $f<br>";
    $i++;
}

echo "<h3>Or</h3>";

for($i = 0; $i < count($fruit); $i++) {
    print "<p>Fruit Nr.: $i - $fruit[$i]</p>";
}

echo "<h2>Print all fruit sorted by alphabet:</h2>";

sort($fruit);

for($i = 0; $i < count($fruit); $i++) {
    print "<p>Fruit Nr.: $i - $fruit[$i]</p>";
}

echo "<h2>Print all fruit that start with a vowel:</h2>";

$vowels = ["a", "A", "e", "E", "i", "I", "o", "O", "u", "U"];

for($i = 0; $i < count($fruit); $i++) {
    if(in_array($fruit[$i][0], $vowels)) {
        echo "<p>Fruit Nr.: $i - $fruit[$i]</p>";
    }
}

echo "<h2>Print out the fruit we have most of:</h2>";

$fruit2 = [
    "Apple" => 23,
    "Orange" => 52,
    "Banana" => 25,
    "Kiwi" => 18,
    "Avocado" => 32,
    "Elderberry" => 55,
];

$i = 0;
$v = "";

foreach($fruit2 as $f => $g) {
    if($g > $i) {
        $i = $g;
        $v = $f;
    }
}

echo "We have most of $v";

echo "<h3>Or</h3>";

asort($fruit2);
echo "We have most of " . array_key_last($fruit2);

echo "<h2>Print out ...:</h2>";