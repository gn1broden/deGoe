<?php
session_start();
//date_default_timezone_set('europe/London');
$user = $_SESSION['user'];
$beer = $_SESSION['beer'];
$wine = $_SESSION['wine'];
$spirit = $_SESSION['spirit'];
$shot = $_SESSION['shot'];
?>
<!DOCTYPE html>
<html lang="en" class="user-page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/input.css">
    <title><?php $user ?></title>
</head>
<body>
<h1>Välkommen <?php echo $user ?></h1>
<p>Du har hittills konsumerat följande enheter</p>
<p><?php echo 'Öl(40cl): ' .$beer ?></p>
<p><?php echo 'Vin: ' .$wine ?></p>
<p><?php echo 'Grogg(4-6cl): ' .$spirit ?></p>
<p><?php echo 'Shots(2cl): ' .$shot ?></p>

<form class="update-form" method="post" action="userPage.php">
    <h3>Fyll i ny bläcka</h3>
    <p>Öl</p>
    <input class="beer" type="number" name="beer" value="0" min="0" max="100" step="1"/>
    <p>Vin</p>
    <input class="wine" type="number" name="wine" value="0" min="0" max="100" step="1">
    <p>Grogg</p>
    <input class="spirit" type="number" name="spirit" value="0" min="0" max="100" step="1">
    <p>Shot</p>
    <input class="shot" type="number" name="shot" value="0" min="0" max="100" step="1">
    <p>Kommentar</p>
    <input class="comment" type="text" name="comment">
    <input type="submit" onclick="myAlert('Sidan kommer att laddas om med fräsha nuffror!')" name="submit" value="Uppdatera">
</form>


<?php

    if(isset($_POST['submit'])){
    //if(isset($_POST['beer']) || isset($_POST['wine']) || isset($_POST['spirit']) || isset($_POST['shot'])){
        
        $con = mysqli_connect("den1.mysql1.gear.host","userdrinks","Zz4pS~Y00O~0","userdrinks");
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        //VALUES FROM INPUT
        $postBeer = $_POST['beer'];
        $postWine = $_POST['wine'];
        $postSpirit = $_POST['spirit'];
        $postShot = $_POST['shot'];
        $comment = $_POST['comment'];


        //TOTAL
        $beer += $postBeer;
        $wine += $postWine;
        $spirit += $postSpirit;
        $shot += $postShot;

        $_SESSION['beer'] = $beer;
        $_SESSION['wine'] = $wine;
        $_SESSION['spirit'] = $spirit;
        $_SESSION['shot'] = $shot;

        $timestamp = date("Y-m-d H:i:sa");

        mysqli_query($con,"INSERT INTO log (user,beer,wine,spirit,shot,comment,date) VALUES ('$user','$postBeer','$postWine','$postSpirit','$postShot','$comment','$timestamp')");
        mysqli_query($con,"UPDATE user SET beer = '$beer', wine = '$wine', spirit = '$spirit', shot = '$shot' WHERE user = '$user'");

    } 
?>
    
</body>

</html>

<script>
    function myAlert(text){
        alert(text);

        header("Refresh:0");
    }
</script>

