<!DOCTYPE html>
<html>
    <head>
        <title>COMP 4711 Lab 1</title>
    </head>
    <body>
    <?php
    // tic tac toe
    if (isset($_GET["board"])) {

        $squares = $_GET["board"];

        $game = new Game($squares);

        if ($game->winner("x")) {
            echo "X wins.";
        } else if ($game->winner("o")) {
            echo "O wins.";
        } else {
            echo "No winner yet.";
        }
    }

    ?>
    </body>
</html>

<?php

class Game {
    var $position;

    function __construct($squares) {
        if (strlen($squares) < 9) {
            $this->position = str_pad($squares, 9, "-");
        } else {
            $this->position = str_split($squares);
        }
    }

    function winner($token) {
        // rows
        for ($row = 0; $row < 3; $row++) {
            if (($this->position[3*$row]    == $token) &&
                ($this->position[3*$row+1]  == $token) &&
                ($this->position[3*$row+2]  == $token)) {
                return true;
            }
        }
        // cols
        for ($col = 0; $col < 3; $col++) {
            if (($this->position[$col]      == $token) &&
                ($this->position[$col+3]    == $token) &&
                ($this->position[$col+6]    == $token)) {
                return true;
            }
        }
        // diag 1
        if (($this->position[0] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[8] == $token)) {
            return true;
        }
        // diag 2
        if (($this->position[2] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[6] == $token)) {
            return true;
        }

        return false;
    }
}

?>