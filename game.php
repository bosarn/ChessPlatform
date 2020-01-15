<?php
require_once "lib/autoload.php";

$game = $_POST['game'];
$match = $_POST['match'];
$myid = $_SESSION['usr_id'];

$gameID = $_SESSION['GameID'];
$IDwhite =$_SESSION['IDwhite'];
$IDblack =$_SESSION['IDblack'];

if (isset($_SESSION['GameID'])){
 $sql = "SELECT gam_usr_black_id,gam_usr_white_id FROM wdev_arno.game Where gam_status=1 and gam_usr_white_id = $IDwhite and gam_usr_black_id = $IDblack ";
 $data= GetData($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="vieuwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="css/opmaak.css">
    <link rel="stylesheet" href="css/home.css"
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/chessboard-1.0.0.css">
    <link rel="stylesheet" href="css/opmaak.css">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/0.10.2/chess.js"></script>  CDN VOOR SCHAAKBORD IN CASE LOCAL DOES NOT WORK-->
    <script src="javascript/chessboard-1.0.0.js"></script>
    <script src="javascript/chess.js"> </script>

    <title> Chessplatform - Game</title>
</head>
<body class="accountbody">
<header class="accountheader">
    <nav id="metanav">
        <a href="home.php" type="logo"><img src="img/logonavw.png"  class="logonav" alt=""></a>
        <ul class="metanav">
            <li><a href="home.php" type="" title="" class="">Home</a></li>
            <li><a href="account.php" type="" title="" class="">Account</a></li>
            <li><a href="friends.php" type="" title="" class="actiefitemmeta">Friends</a></li>
            <li><a href="contact.php" type="" title="">Contact</a></li>
            <li><a href="lib/logout.php" type="" title="" class="logout">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="chessboard">
        <div class="matchers">
            <?php
            echo "<div class='matcheduserblack'>";
            FriendLoadImage($IDblack, 'chessimageblack');
            echo "<p> Name:"; LoadName($IDblack); echo "</p>";
            echo "<p> Rating:"; LoadRating($IDblack);echo "</p>";
            echo "</div>";

            echo "<div class='matcheduserwhite'>";
            FriendLoadImage($IDwhite, 'chessimagewhite');
            echo "<p> Name:";LoadName($IDwhite);echo "</p>";
            echo "<p> Rating:";LoadRating($IDwhite);echo "</p>";
            echo "</div>";
            ?>
        </div>

        <div id="myBoard" class="myboard"></div>
        <div class="matcheduserwhite">
            <h2 class="friendsh2"> Position</h2>

            <h3> FEN notation</h3>
            <p id="fen"></p>
            <h3> PGN notation</h3>
            <p id="pgn"></p>
            <form method="post" name="pgn" action="lib/endgame.php">

                <?php
                echo "<input type=hidden name=IDblack value='$IDblack'>";
                echo "<input type=hidden name=IDwhite value='$IDwhite'>";
                echo "<input type=hidden name=gameID value='$gameID'>";
                ?>
                <button type="submit" name="submit" class="accountbutton"> End game!</button>
            </form>
            <form method="post" name="black" action="lib/endgame.php">

                <?php
                echo "<input type=hidden name=IDblack value='$IDblack'>";
                echo "<input type=hidden name=IDwhite value='$IDwhite'>";
                echo "<input type=hidden name=gameID value='$gameID'>";
                ?>
                <button type="submit" name="black" class="accountbutton"> Black Wins!</button>
            </form>
            <form method="post" name="white" action="lib/endgame.php">

                <?php
                echo "<input type=hidden name=IDblack value='$IDblack'>";
                echo "<input type=hidden name=IDwhite value='$IDwhite'>";
                echo "<input type=hidden name=gameID value='$gameID'>";
                ?>
                <button type="submit" name="white" class="accountbutton"> White Wins!</button>
            </form>


        </div>
        <script>
            var board = null
            var game = new Chess()
            var $status = $('#status')
            var $fen = $('#fen')
            var $pgn = $('#pgn')

            function onDragStart (source, piece, position, orientation) {
                // do not pick up pieces if the game is over
                if (game.game_over()) return false

                // only pick up pieces for the side to move
                if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
                    (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
                    return false
                }
            }

            function onDrop (source, target) {
                // see if the move is legal
                var move = game.move({
                    from: source,
                    to: target,
                    promotion: 'q' // NOTE: always promote to a queen for example simplicity
                })

                // illegal move
                if (move === null) return 'snapback'

                updateStatus()
            }

            // update the board position after the piece snap
            // for castling, en passant, pawn promotion
            function onSnapEnd () {
                board.position(game.fen())
            }

            function updateStatus () {
                var status = ''

                var moveColor = 'White'
                if (game.turn() === 'b') {
                    moveColor = 'Black'
                }

                // checkmate?
                if (game.in_checkmate()) {
                    status = 'Game over, ' + moveColor + ' is in checkmate.'
                }

                // draw?
                else if (game.in_draw()) {
                    status = 'Game over, drawn position'
                }

                // game still on
                else {
                    status = moveColor + ' to move'

                    // check?
                    if (game.in_check()) {
                        status += ', ' + moveColor + ' is in check'
                    }
                }

                $status.html(status)
                $fen.html(game.fen())
                $pgn.html(game.pgn())
            }

            var config = {
                draggable: true,
                position: 'start',
                onDragStart: onDragStart,
                onDrop: onDrop,
                onSnapEnd: onSnapEnd
            }
            board = Chessboard('myBoard', config)

            updateStatus()
        </script>
    </section>


</main>


</body>