<!DOCTYPE html>
<html>
<head>
    <title>login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
</head>
<body>
    <?php 
        session_start();
    ?>
    <div class="card w-25 mx-auto my-5">
        <div class="card-header bg-dark text-white">Login</div>
        <div class="card-body">
            <form action="./verifica.php" method="post">
                <div class="form-group ">
                <label for="username">Username:</label>
                <input name="username" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-dark">Login</button>
                </div>
                <?php if(isset($_SESSION["autorizzato"]) && $_SESSION["autorizzato"] == 0): ?>
                    <p class="text-danger">Username e/o Password incorretti</p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>