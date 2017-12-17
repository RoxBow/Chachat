<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo 'Chachat | ' . ucfirst($action); ?></title>
    <link rel="stylesheet" href="<?= $css_path ?>">
    <link rel="stylesheet" href="<?= $fontawesome_path ?>">

    <script src='http://localhost:3000/socket.io/socket.io.js'></script>

    <?php
        if ($action){
            echo "<script>var socket = io('http://localhost:3000');</script>";
        }
    ?>
</head>
<body>

<?php include($view_path); ?>

    <script src='./dists/js-compiled/jquery.js'></script>
    <script src='./dists/js-compiled/chat.js'></script>
    <script src='./dists/js-compiled/main.js'></script>
    <script src='./dists/js-compiled/home.js'></script>
</body>
</html>