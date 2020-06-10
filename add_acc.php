<?php require_once 'dbconnection.php';?>
<?php include_once 'navbar.php';?>
<?php
    if ($_SESSION["ruolo"]!="admin") {
        echo "<h1>Area riservata, accesso negato.</h1>";
        echo "Per effettuare il login clicca <a href='login.php'><font color='blue'>qui</font></a>";
        die;
    }
    try{
        $query="SELECT * FROM users;";
        $rs = $dbconnection->query($query);
        $accounts= $rs->fetchAll();
    }catch (PDOException $e) {
        header("location: errore.php");
    }
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $password2 = md5($_POST["password2"]);
        $ruolo = $_POST["ruolo"];
        if ($password!=$password2){
            header("location: gestion_acc.php");
            return ;
        };
        foreach($accounts as $account){
            if($account['username']==$username){
                header("location: gestion_acc.php");
                return ;
            }
        };
        try{
            $sql = "INSERT INTO users (username, password, ruolo, img) VALUES (?,?,?,?)";
            $dbconnection->prepare($sql)->execute([$username,$password,$ruolo,"img/guest.png"]);
            header("location: gestion_acc.php");
        }catch (PDOException $e) {
            header("location: errore.php");
        }
    }
?>