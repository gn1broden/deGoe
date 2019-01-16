<?php
    session_start();
    //date_default_timezone_set('europe/London');
    $user = $_SESSION['user'];
    $beer = $_SESSION['beer'];
    $wine = $_SESSION['wine'];
    $spirit = $_SESSION['spirit'];
    $shot = $_SESSION['shot'];

    if(isset($_POST['submit'])){
    //if(isset($_POST['beer']) || isset($_POST['wine']) || isset($_POST['spirit']) || isset($_POST['shot'])){
        
        include "phpFiles/db.php";

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
    include "templates/userPage.html";
?>

<script>
    function myAlert(text){
        alert(text);

        header("Refresh:0");
    }
</script>

