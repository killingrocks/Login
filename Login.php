<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    session_start();
}

// Registration

if (isset($_GET["signin"])) {

    $file1 = fopen("assignment11-accounts-info.txt", "r");
    while (!feof($file1)) {
        $line = fgets($file1);
        if (strlen($line) > 0) {
            $arr = explode(";", $line);
if($arr[0]== $_GET['uname'] && $arr[1] ==$_GET['psw'] ){
$_SESSION['uname']=$arr[0];
$_SESSION['psw']=$arr[1];
$_SESSION['fname']=$arr[2];
$_SESSION['lname']=$arr[3];
$_SESSION['color']=$arr[4];
$_SESSION['title']=$arr[5];
$_SESSION['url']=$arr[6];
$_SESSION['login'] = true;

}

}
}
if (!isset($_SESSION['login'])){
                $problem = "Invalid Username or password";
                $url = "Location: assignment11.php?problem=$problem";
                header($url);
                exit;
            }

fclose($file1);
}


if (isset($_GET["Signup"])) {
if ($_GET["uname2"]=="" ||$_GET["psw2"]=="" ||$_GET["fname"]==""||$_GET["lname"]=="" ){
               $problem = "Invalid Sign up";
                $url = "Location: assignment11.php?problem=$problem";
                header($url);
                exit;
}

    $file1 = fopen("assignment11-accounts-info.txt", "r");
    while (!feof($file1)) {
        $line = fgets($file1);
        if (strlen($line) > 0) {
            $arr = explode(";", $line);
            if ($arr[0] == $_GET['uname2']) {
                $problem = "Invalid user a different name";
                $url = "Location: assignment11.php?problem=$problem";
                header($url);
                exit;
            }
        }
    }
    fclose($file1);

    // need to open the file
    // append this user's info to the file
    //assignment11-accounts-info
    $_SESSION['uname'] = $_GET['uname2'];
    $_SESSION['psw'] = $_GET['psw2'];
    $_SESSION['fname'] = $_GET['fname'];
    $_SESSION['lname'] = $_GET['lname'];
    $_SESSION['color'] = "white";
    $_SESSION['title'] = "Welcome to  Nicholaus Marsden Assignment 11 PHP page!";
    $_SESSION['url'] = "http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Stick_Figure.svg/170px-Stick_Figure.svg.png";
    $file = fopen("assignment11-accounts-info.txt", "a");
    fwrite($file, $_SESSION['uname'] . ";" . $_SESSION['psw'] . ";" . $_SESSION['fname'] . ";" . $_SESSION['lname'] . ";" . $_SESSION['color'] . ";" . $_SESSION['title'] . ";" . $_SESSION['url'] . "\n");
    fclose($file);
    $_SESSION['login'] = true;
    $_SESSION['uname'] = $_GET['uname2'];

}
/*if(isset($_SESSION['login'])){
$_SESSION['login'] = true;
*/


if (!isset($_SESSION['login'])) {

    ?>
    <html>
    <head>
        <title> Welcome to Nicholaus Marsden Assignment11</title>
    </head>
    <body>
    <h1>Welcome to Nicholaus Marsden Assignment11</h1>

    <?php
    if (isset($_GET['problem'])) {
        echo '<p style="color:red;">' . $_GET['problem'] . '</p>';
    }
    ?>
  <p> SIGN IN </p>
<form method = "get" action ="assignment11.php">
User name: <input name="uname" type ="text" value=""/>
<br>
Password: <input name="psw" type ="password" value=""/>
<br>
<input type ="submit"  name = "signin"value = "Sign in" />

</form>
    <p> SIGN UP </p>
    <form name="form1" method="get" action="assignment11.php" onsubmit="return  ">
        User Name : <input type="text" name="uname2" value="">
        <br><br>
        Password : <input type="password" name="psw2" value="">
        <br><br>
        First Name: <input type="text" name="fname" value="">
        <br><br>
        Last Name : <input type="text" name="lname" value="">
<br><br>
  <input type="submit" name= "Signup" value=" Sign Up" />  
</form>
</body>
</head>
<?php
}
else{


?>
<html>
<body>
<?php

/*if(isset($_GET["Signup"]))
{
    // need to open the file
    // append this user's info to the file
//assignment11-accounts-info
$file = fopen("assignment11-accounts-info.txt", "r") or exit("Unable to open file!");
    while (!feof($file)) {
        $line = fgets($file);
        $line = trim($line);
        if (strlen($line) > 0) {
            $arr = explode(";", $line);
if($arr[0]== $_SESSION['uname']){
            
$_SESSION['fname'] = $arr[2] ;
$_SESSION['lname'] = $arr[3] ;
$_SESSION['color'] = $arr[4];
$_SESSION['title'] = $arr[5] ;
$_SESSION['url'] = $arr[6] ;}
        }
    }
fclose($file);
}*/





if(isset($_GET["Submit"])){
$data ='';
$data2 = '';
$_SESSION['fname'] = $_GET['fname2'] ;
$_SESSION['lname'] = $_GET['lname2'];
$_SESSION['color'] = $_GET['color'];
$_SESSION['title'] = $_GET['title'] ;
$_SESSION['url'] = $_GET['url'] ;
$fileContent = "";

$file = fopen("assignment11-accounts-info.txt", "r") or exit("Unable to open file!");
    while (!feof($file)) {
        $line = fgets($file);
        
        if (strlen($line) > 0) {
            $arr = explode(";", $line);
if($arr[0]== $_SESSION['uname']){
$fileContent.= $_SESSION['uname'] . ";" . $arr[1] . ";" . $_SESSION['fname'] . ";" . $_SESSION['lname'] . ";" . $_SESSION['color'] . ";" . $_SESSION['title'] . ";" . $_SESSION['url'] . "\n";
} else {
                    $fileContent .= $line;
                }
            }
        }
        fclose($file);

        // Write the content
        $file2 = fopen("assignment11-accounts-info.txt", "w") or exit("Unable to open file!");
        fwrite($file2, $fileContent);
        fclose($file2);
    }




$color = $_SESSION['color'];

echo "<body style = 'background-color:$color'>";
?>
</html>
</body>
<h1> <?php echo "Welcome ".$_SESSION['uname'];?></h1>

<img src="<?=$_SESSION['url'] ?>" alt="Mountain View" style="width:304px;height:228px;">
<br><br>
<form name= "form3"  method="get" action="assignment11.php" />
<input type="submit" name = "logout" value="Log out" />  
<br><br>

<form name= "form2"  method="get" action="assignment11.php?uname2= <?=$_GET['uname2']?>&psw2= <?=$_GET['psw2']?>&fname= <?=$_GET['fname']?>&lname= <?=$_GET['lname']?>"> 
First Name: <input type="text" name="fname2" value ="<?=$_SESSION['fname']?>">
<br><br>
Last Name : <input type= "text" name="lname2" value ="<?=$_SESSION['lname']?>">
<br><br> 
Background color: <input type="text" name="color" value ="<?=$_SESSION['color']?>">
<br><br>
Title : <input type= "text" name="title" value ="<?=$_SESSION['title']?>"/>
<br><br> 
Image: <input type="text" name="url" value ="<?=$_SESSION['url']?>"/>
<br><br>

  <input type="submit" name = "Submit" value="Edit Account Information" />  
</body>
</html>
<?php
}

?>