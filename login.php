

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="css/input.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <title>De G0e</title>
</head>
<body>
    
<?php
/**
 * Inloggnigssida.
 * Sidan validerar och kollar om uppgifterna stämmer mot databasen.
 * @param author Totte@ingabekymmer.se
 * 
 */
session_start();
?>

<!-- andvändare = admin@admin.se pw= Admin123  -->
<div class="background-wrapper">
    <form class="login-form" method="post" action="login.php">
        <h3>Logga in</h3>
        <input type="text" name="user" placeholder="ange andvändarnamn">
        <input type="password" name="password" placeholder="ange lösenord">
        <input type="submit" name="submit" value="Logga in">
    </form>
</div>


<?php
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
    $con = mysqli_connect("den1.mysql1.gear.host","userdrinks","Zz4pS~Y00O~0","userdrinks");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $result = mysqli_query($con,"SELECT * FROM user WHERE user = '$user' AND password = '$password' LIMIT 1");	 // * väljer alla fält
    $data = mysqli_fetch_array($result);
    //if($email == $correctemail && $password == $correctpass)
    if(mysqli_num_rows($result) > 0){
        //Skapa en session med namn login och tilldelar värdet 1
        $_SESSION['user'] = $user;
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


?>
</body>
</html>