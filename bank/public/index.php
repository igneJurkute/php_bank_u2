<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <script src="app.js"></script>
    <title>Bank - hello</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card bank-card">
                    <div class="card-header welcome-align navbar-brand text-wrap php-bank">
                        <h1>PHP bank</h1>
                    </div>
                    <div class="card-body index-card">
                        <div class="welcome-align row g-3">

                            <?php if (isset($_SESSION['email'])) : ?>
                                <div>
                                    <a class="btn btn-outline-secondary btn-act" href="http://localhost/php_bank_u2/bank/public/main.php">Back to main</a>
                                </div>
                                <form action="http://localhost/php_bank_u2/bank/public/login.php?logout" method="post">
                                    <button type="submit" class="btn btn-dark btn-act">Log out "<?= $_SESSION['email'] ?>"</button>
                                </form>

                            <?php else : ?>
                                <div>
                                    <a class = "btn btn-warning btn-lg sign-in" href="http://localhost/php_bank_u2/bank/public/login.php">Sign in</a>
                                </div>

                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>