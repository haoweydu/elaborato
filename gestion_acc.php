<html>
<head>
    <title>Viaggi di istruzione</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once 'navbar.php';?>
<?php require_once 'dbconnection.php';?>
<?php
    try{
        $query="SELECT * FROM users;";
        $rs = $dbconnection->query($query);
        $accounts= $rs->fetchAll();
    }catch (PDOException $e) {
        header("location: errore.php");
    }
?>
<div class="card w-50 mx-auto mt-2">
    <div class="card-header bg-dark text-white">Lista account</div>
    <div class="card-body">
        <div id="account"></div>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nuovoaccount">
        Nuovo account
        </button>
    </div>

</div>
<div class="modal" id="nuovoaccount">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuovo account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="nuovobody">
            <form action="add_acc.php" method="post">
                <div class="form-group ">
                <label for="username">Username:</label>
                <input name="username" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                <label for="password2">Ripeti password:</label>
                <input name="password2" type="password" class="form-control" placeholder="Password">
                </div>
                <label for="sel1">Select list (select one):</label>
                <select name="ruolo" class="form-control" id="sel1">
                    <option value="admin">Admin</option>
                    <option value="insegnante">Insegnante</option>
                    <option value="studente">Studente</option>
                </select>
                <div class="form-group">
                <button type="submit" class="btn btn-dark">aggiungi</button>
                </div>
                <p class="text-danger" id="errore"></p>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        lista();
    });
    function lista(){
    let account=[
        <?php
        echo json_encode($accounts);
        ?>
    ];
    let string="";
    account=account[0];
    account.forEach(function(item) {
        string += `<div class="media my-2 ml-2 p-1">
                    <img src="`+item['img'] +` " class="media-object rounded-circle mt-1" style="width:70px; height:70px">
                    <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                        <h4 class="media-heading">` + item['username'] + `(`+item['ruolo'] +`) </h4>
                        <p>`+ item['description'] +` </p>
                    </div>
                </div>`;
    });
    $("#account").html(string);
    }
</script>
</body>
</html>