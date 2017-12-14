<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?php echo ucfirst($action); ?></title>
  <link rel="stylesheet" href="<?= $css_path ?>">
  <link rel="stylesheet" href="<?= $fontawesome_path ?>">
</head>
<body>

	<?php include($view_path); ?>

  <script src='./dists/js/jquery-3.2.1.min.js'></script>
  <script src='http://localhost:3000/socket.io/socket.io.js'></script>
  <script src='./dists/js/main.js'></script>
  <script src='./dists/js/home.js'></script>
</body>
</html>