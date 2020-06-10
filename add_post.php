<?php require_once 'dbconnection.php';?>
<?php include_once 'navbar.php';?>
<?php
    if ($_SESSION["ruolo"]!="insegnante") {
        echo "<h1>Area riservata, accesso negato.</h1>";
        echo "Per effettuare il login clicca <a href='login.php'><font color='blue'>qui</font></a>";
        die;
    }
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_FILES['img']) || !is_uploaded_file($_FILES['img']['tmp_name'])) {   
        };
        $uploaddir = 'img/';
        $img_tmp = $_FILES['img']['tmp_name'];
        $img_name = $_FILES['img']['name'];
        if (move_uploaded_file($img_tmp, $uploaddir . $img_name)) {
            $img=$uploaddir . $img_name;
        }else{
            $img="img/guest.png";
        };
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["descrizione"];
        try{
            $sql = "INSERT INTO post (name, price, description, img, id_utente) VALUES (?,?,?,?,?)";
            $dbconnection->prepare($sql)->execute([$name,$price,$description,$img,$_SESSION["utente"]]);
            header("location: pubblicatidame.php");
        }catch (PDOException $e) {
            die($e);
            header("location: errore.php");
        }
    }
?>