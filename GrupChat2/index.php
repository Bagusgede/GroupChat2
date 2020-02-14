<?php

    require 'include/connection.php';
    require 'include/class/UserClass.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/uikit.min.css" />
        <script src="assets/js/uikit.min.js"></script>
        <script src="assets/js/uikit-icons.min.js"></script>
    </head>
    <body>
        <section>
        <?php
            require 'login.php';
            ?>

            <div class="banner"></div>
        </section>
    </body>
</html>