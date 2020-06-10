<?php
session_start();
require "dbconnection.php";
$username=$_POST['username'];
$password=md5($_POST['password']);
try{
    $query="SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $rs = $dbconnection->query($query);
    $row = $rs->fetch();
}catch (PDOException $e) {
    header("location: errore.php");
}
$id=$row['username'];
if($id==NULL){
    $_SESSION["autorizzato"] = 0;
    header("location: login.php");
}else{
    $_SESSION["autorizzato"] = 1;
    $_SESSION["id"] = $id;
    $_SESSION["utente"] = $row["id"];
    $_SESSION["ruolo"] = $row["ruolo"];
    header("location: app.php");
}
?>