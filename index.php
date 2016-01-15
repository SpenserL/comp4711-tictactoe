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

    echo "<br>";

    if (isset($_GET["hours"])) {
        $hoursworked = $_GET["hours"];
    } else {
        $hoursworked = 10;
    }
    $rate = 12;
    if ($hoursworked > 40) {
        $total = $hoursworked * $rate * 1.5;
    } else {
        $total = $hoursworked * $rate;
    }

    echo ($total > 0) ? "You owe me " . $total : "Your're Welcome";

    // tic tac toe
    if (isset($_GET["board"])) {

        $position = $_GET["board"];
        $squares = str_split($position);
        echo "<br>";

        if (winner("x", $squares)) {
            echo "You win.";
        } else if (winner("o", $squares)) {
            echo "I win.";
        } else {
            echo "No winner yet.";
        }
    }

    ?>
    </body>
</html>

<?php
function winner($token, $position) {
    $won = false;
    // row 1
    if (($position[0] == $token) && ($position[1] == $token) &&($position[2] == $token)) {
        $won = true;
    // row 2
    } else if ($position[3] == $token && ($position[4] == $token) && ($position[5] == $token)) {
        $won = true;
    // row 3
    } else if ($position[6] == $token && ($position[7] == $token) && ($position[8] == $token)) {
        $won = true;
    // col 1
    } else if ($position[0] == $token && ($position[3] == $token) && ($position[6] == $token)) {
        $won = true;
    // col 2
    } else if ($position[1] == $token && ($position[4] == $token) && ($position[7] == $token)) {
        $won = true;
    // col 3
    } else if ($position[2] == $token && ($position[5] == $token) && ($position[8] == $token)) {
        $won = true;
    // diag 1
    } else if ($position[0] == $token && ($position[4] == $token) && ($position[8] == $token)) {
        $won = true;
    // diag 2
    } else if ($position[2] == $token && ($position[4] == $token) && ($position[6] == $token)) {
        $won = true;
    }
    return $won;
}
?>