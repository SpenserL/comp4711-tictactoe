<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>COMP 4711 Lab 1</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css" rel="stylesheet">
    </head>
    <body>

    <div class="container">
        <div class="page-header text-center">
            <h1 class="visible-lg">COMP 4711 - Lab 1</h1>
            <h2 class="visible-md visible-sm visible-xs">COMP 4711 - Lab 1</h2>
        </div>

        <div class="text-center">
            <?php

            $board = (isset($_GET["board"])) ? $_GET["board"] : null;
            $game = new Game($board);
            $game->run();
            ?>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>

<?php

class Game {
    var $position;
    var $game_over;

    // construct the game object
    public function __construct($board) {
        // check to see if the passed in board is empty or invalid
        // if invalid, pad with - until of length 9
        if (empty($board) || strlen($board) < 9) {
            $this->position = str_pad($board, 9, "-");
            // split into an array
            $this->position = str_split($this->position);
        } else {
            $this->position = str_split($board);
        }

        $game_over = false;
    }

    // game loop
    public function run() {
        $msg = null;

        if ($this->winner("x")) {
            $msg = "You Won!";
            $this->game_over = true;
        } else {
            $this->move();

            if ($this->winner("o")) {
                $msg = "You Lose!";
                $this->game_over = true;
            }
        }

        if ($this->tied()) {
            $msg = "Tie Game!";
            $this->game_over = true;
        }
        echo "<h3>$msg</h3>";

        $this->display();
    }

    // display the game board
    public function display() {
        echo "<table class='table-centered' cols='3'>";
        echo "<tr>"; // open the first row
        for ($pos = 0; $pos < 9; $pos++) {
            echo $this->show_cell($pos);
            if ($pos % 3 == 2) echo "</tr><tr>"; // start a new row for the next square
        }
        echo "</tr>"; // close the last row
        echo "</table>";
        if ($this->game_over) {
            echo "<br><br><a href='?'>New Game</a>";
        }
    }
    // get the appropriate character to display on the game board, else return a hyphen
    private function show_cell($cell) {
        $token = $this->position[$cell];

        if ($token != "-") {
            return "<td class='text-center'>" . $token . "</td>";
        }

        $this->newposition = $this->position;
        $this->newposition[$cell] = "x";

        $move = implode($this->newposition);
        $link = "/comp4711-tictactoe/index.php?board=" . $move;

        if (!$this->game_over) {
            return "<td><a href='$link'>-</a></td>";
        } else {
            return "<td></td>";
        }
    }

    // check if the game tied
    private function tied() {
        for ($i = 0; $i < 9; $i++) {
            if ($this->position[$i] == "-") {
                return false;
            }
        }
        return true;
    }

    private function move() {
        $done = false;

        while (!$done) {
            $rand = rand(0, 8);
            if ($this->position[$rand] == "-") {
                $this->position[$rand] = "o";
                $done = true;
            }
        }
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