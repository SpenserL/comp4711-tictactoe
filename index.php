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
        // check to ensure board param is valid (i.e. prevents invalid indexing)
        if (strlen($position) < 9) {
            $position = str_pad($position, 9, "-");
        }
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
    // rows
    for ($row = 0; $row < 3; $row++) {
        if (($position[3*$row] == $token) && ($position[3*$row+1] == $token) && ($position[3*$row+2] == $token)) {
            return true;
        }
    }
    // cols
    for ($col = 0; $col < 3; $col++) {
        if (($position[$col] == $token) && ($position[$col+3] == $token) && ($position[$col+6] == $token)) {
            return true;
        }
    }
    // diag 1
    if ($position[0] == $token && ($position[4] == $token) && ($position[8] == $token)) {
        return true;
    }
    // diag 2
    if ($position[2] == $token && ($position[4] == $token) && ($position[6] == $token)) {
        return true;
    }

    return false;
}
?>