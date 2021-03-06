<?php
$UserID = (int) $this->session->userdata("ID");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('home') ?>"><?php echo MY_SITE_NAME ?></a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (!$UserID && $UserID == 0) { ?>
                        <li>
                            <a href="<?php echo base_url('register') ?>"><span class="glyphicon glyphicon-user"></span> Register</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo base_url('login') ?>"></span><?php echo isset($UserID) && $UserID > 0 ? "My Account" : "Login"; ?></a>
                    </li>
                </ul>
            </div>
        </nav>

    </body>
</html>
