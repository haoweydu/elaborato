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
        $stmt = $dbconnection->prepare("SELECT * FROM post WHERE id_utente=?");
        $stmt->execute([$_SESSION["utente"]]);
        $posts= $stmt->fetchAll();

    }catch (PDOException $e) {
        header("location: errore.php");
    }
?>
<div class="card w-50 mx-auto mt-2">
    <div class="card-header bg-dark text-white">Pubblicati da me</div>
    <div class="card-body">
        <div id="posts"></div>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nuovoaccount">
        Nuovo Post
        </button>
    </div>

</div>
<div class="modal" id="nuovoaccount">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuovo post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="nuovobody">
            <form enctype="multipart/form-data" action="add_post.php" method="post">
                <label for="img">Foto:</label>
                <input type="file" name="img" id="fileToUpload">
                <div class="form-group ">
                <label for="name">Luogo:</label>
                <input name="name" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                <label for="price">Prezzo:</label>
                <input name="price" type="number" class="form-control" placeholder="prezzo">
                </div>
                <div class="form-group">
                <label for="descrizione">Descrizione:</label>
                <textarea name="descrizione" class="form-control" rows="5" placeholder="commento"></textarea>
                </div>
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
    let posts=[
        <?php
        echo json_encode($posts);
        ?>
    ];
    let string="";
    posts=posts[0];
    posts.forEach(function(item) {
        string += `<div class="media my-2 ml-2 p-1">
                    <img src="`+item['img'] +` " class="media-object rounded-circle mt-1" style="width:70px; height:70px">
                    <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
                        <h4 class="media-heading">` + item['name'] +` </h4>
                        <p><b>Prezzo viaggio: ` + item['price'] + "</b><br>"+ item['description'] +` </p>
                    </div>
                </div>`;
    });
    $("#posts").html(string);
    }
</script>
</body>
</html>