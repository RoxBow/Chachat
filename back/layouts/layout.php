<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?php echo ucfirst($action); ?></title>
  <link rel="stylesheet" href=<?= $css_path ?>>
</head>
<body>
	<?php include($view_path); ?>
  <?php
    /* foreach ($script_tab as $key => $link) {
      # code...
    } */
  ?>
  <script src='./js/main.js'></script>
</body>
</html>