<!DOCTYPE html>
<html>
    <head>
        <title>COMP 4711 Lab 1</title>
    </head>
    <body>
    <?php

    $board = (isset($_GET["board"])) ? $_GET["board"] : null;
    $game = new Game($board);

    if ($game->winner("x")) {
        echo "X wins.";
    } else if ($game->winner("o")) {
        echo "O wins.";
    } else {
        echo "No winner yet.";
    }
    echo "<p>Welcome to George, the evil Tic-Tac-Toe Game.</p><br>";
    $game->display();

    ?>
    </body>
</html>

<?php

class Game {
    var $position;

    // construct the game object
    public function __construct($board) {
        // check to see if the passed in board is empty or invalid
        // if invalid, pad with - until of length 9
        if (empty($board) || strlen($board) < 9) {
            $this->position = str_pad($board, 9, "-");
        }
        // split into an array
        $this->position = str_split($this->position);
    }

    // display the game board
    public function display() {
        echo "<table cols=”3” style=”font­size:large; font­weight:bold”>";
        echo "<tr>"; // open the first row
        for ($pos = 0; $pos < 9; $pos++) {
            echo $this->show_cell($pos);
            if ($pos % 3 == 2) echo "</tr><tr>"; // start a new row for the next square
        }
        echo "</tr>"; // close the last row
        echo "</table>";
    }
    // get the appropriate character to display on the game board, else return a hyphen
    private function show_cell($cell) {
        $token = $this->position[$cell];

        if ($token != "-") {
            return "<td>" . $token . "</td>";
        }

        $this->newposition = $this->position;
        $this->newposition[$cell] = "o";

        $move = implode($this->newposition);
        $link = "/?board=" . $move;

        return "<td><a href='$link'>-</a></td>";
    }
    // tic tac toe logic for finding a winner
    public function winner($token) {
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