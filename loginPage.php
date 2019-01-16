<?php
    /**
     * Inloggnigssida.
     * Sidan validerar och kollar om uppgifterna stämmer mot databasen.
     * @param author Totte@ingabekymmer.se
     * 
     */
    session_start();
    //kollar om formulärdata har skickats, i detta fallet user och password
    if(isset($_POST['user']) && isset($_POST['password']))
    {

        if($_POST['user'] == '')
        { 
            echo "user saknas";
            //die;
        }
        if($_POST['password'] == ''){ 
            echo "lösenord saknas";
        }
    

        $user = $_POST['user'];
        $password = $_POST['password'];

        // validera user och password på tabellen User 
        include "phpFiles/db.php";

        $result = mysqli_query($con,"SELECT * FROM user WHERE user = '$user' AND password = '$password' LIMIT 1");	 // * väljer alla fält
        $data = mysqli_fetch_array($result);
        //if($email == $correctemail && $password == $correctpass)
        if(mysqli_num_rows($result) > 0){
            //Skapa en session med namn login och tilldelar värdet 1
            $_SESSION['user'] = $user ;
            $_SESSION['password'] = $password;
            $_SESSION['userId'] = $data['userId'];
            $_SESSION['beer'] = $data['beer'];
            $_SESSION['wine'] = $data['wine'];
            $_SESSION['spirit'] = $data['spirit'];
            $_SESSION['shot'] = $data['shot'];

            header('location:userPage.php');
        }
        else{
            alert("Felaktiga uppgifter, fyll i igen!");
        }


    }
    include "templates/login.html";
?>

