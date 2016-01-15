<!DOCTYPE html>
<html>
    <head>
        <title>COMP 4711 Lab 1</title>
    </head>
    <body>
    <?php

    $name = "Jim";
    $what = "geek";
    $level = 10;
    echo "Hi, my name is " . $name . " and I am a level " . $level . " " . $what;

    // unused ?
    switch ($name) {
        case "Jim":
        $answer = "great";
        break;
        case "George":
        $answer = "unknown";
        break;

        default:
        $answer = "unknown";
    }
    echo "<br>";

    $hoursworked = 10;
    $rate = 12;
    if ($hoursworked > 40) {
        $total = $hoursworked * $rate * 1.5;
    } else {
        $total = $hoursworked * $rate;
    }

    echo ($total > 0) ? "You owe me " . $total : "Your're Welcome";


    ?>
    </body>
</html>