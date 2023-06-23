<?php

$accounts = file_get_contents(__DIR__ . '/../accounts.ser');
$accounts = $accounts ? unserialize($accounts) : [];

$alert = $_GET['alert'] ?? 0;

// Show account details
$accountId = $_GET['id'] ?? null;
$account = null;
if ($accountId) {
    foreach ($accounts as $acc) {
        if ($acc['id'] == $accountId) {
            $account = $acc;
            break;
        }
    }
}

// Withdraw money
$accountId = (int)$_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $amount = $_POST['amount'];
    if ($amount >= 0) {
        foreach ($accounts as &$a) {
            if ($a['id'] == $accountId) {
                if ($a['balance'] >= $_POST['amount']) {
                    $a['balance'] -= $amount;;
                } else {
                    header('Location: ./withdraw-money.php?id=' . $accountId . '&alert=4');
                    die;
                }
            }
        }
        unset($a);

        $accounts = serialize($accounts);
        file_put_contents(__DIR__ . '/../accounts.ser', $accounts);
        header('Location: ./withdraw-money.php?id=' . $accountId);
        die;
    } else {
        header('Location: ./withdraw-money.php?id=' . $accountId . '&alert=8');
        die;
    }
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
    <title>Withdraw money</title>
</head>

<body>

    <?php require __DIR__ . '/menu.php' ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <h5 class="card-header">Withdraw money</h5>
                    <div class="card-body">

                        <table class="table">
                            <tbody>
                                <?php if ($account) : ?>
                                    <tr>
                                        <td><?= $account['accountNo'] ?></td>
                                        <td><?= $account['firstName'] ?></td>
                                        <td><?= $account['lastName'] ?></td>
                                        <td><?= $account['personalId'] ?></td>
                                        <td>
                                        <div class="input-group">
                                                <span class="input-group-text">Balance</span>
                                                <div class="form-control text-end"><?= $account['balance'] ?></div>
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <form class="row g-3 add-money" form action="./withdraw-money.php?id=<?= $accountId ?>" method="post">
                            <div class="col-3">
                                <label for="amount" class="form-label">Enter amount</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="amount" placeholder="..." required>
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-warning">Withdraw</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="link btn btn-outline-warning back-to">
                    <a href="http://localhost/php_bank_u2/bank/public/main.php">Back to main</a>
                </div>

                <div><?php require __DIR__ . '/alert-msg.php' ?></div>

            </div>
        </div>

</body>

</html>