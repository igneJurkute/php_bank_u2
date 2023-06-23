<?php

session_start();

if (isset($_SESSION['email']) && !isset($_GET['logout'])) {
    header('Location: http://localhost/php_bank_u2/bank/public/');
    die;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_GET['logout'])) {
        unset($_SESSION['email']);
        $_SESSION['alert'] = '<div class="alert alert-mini alert-success">
        You have successfully logged out. Enter your login details again to login.</div>';
        header('Location: http://localhost/php_bank_u2/bank/public/login.php');
        die;
    }

    $users = file_get_contents(__DIR__ . '/users.json');
    $users = json_decode($users, 1);
    foreach ($users as $user) {
        if ($user['userFirstName'] == $_POST['userFirstName'] && $user['userLastName'] == $_POST['userLastName'] && $user['email'] == $_POST['email'] && $user['password'] == md5($_POST['password'])) {
            $_SESSION['email'] = $user['email'];
            header('Location: http://localhost/php_bank_u2/bank/public/main.php');
            die;
        }
    }
    $_SESSION['alert'] = '';
    header('Location: http://localhost/php_bank_u2/bank/public/main.php');
    die;
}

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
} else {
    $alert = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <script src="app.js"></script>
    <title>Sign in</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">

                    <div class="card-header welcome-align navbar-brand text-wrap">
                        <h1>Enter your login details</h1>
                    </div>

                    <div class="card-body">
                        <form class="row g-3" method="post">
                            <div class="col-12">
                                <label for="userFirstName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="userFirstName">
                            </div>
                            <div class="col-12">
                                <label for="userLastName" class="form-label">Surname</label>
                                <input type="text" class="form-control" name="userLastName">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-warning btn-lg" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>

                    <?php if ($alert) : ?>
                        <h6><?= $alert ?></h6>
                    <?php endif ?>
                    
                </div>
            </div>
        </div>
    </div>

</body>

</html>