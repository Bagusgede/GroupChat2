<?php
$errorLogin = isset($_GET['error']) ? $_GET['error'] :NULL

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign In</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/uikit.min.css" />
        <script src="assets/js/uikit.min.js"></script>
        <script src="assets/js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="style.css"/>  
  
    </head>
    <body>
    <div class="banner"></div> 

    <div class=" uk-position-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"   uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container-login">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large " >
                            <h3 class="uk-card-title uk-text-center">Log In</h3>
                            <?php if ($errorLogin == '0') : ?>
                                    <p style="color: red; font-style: italic;">Incorrect username or password!</p>
                            <?php endif; ?>

                           <form action="include/action/action-login.php" method="post">
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="user"></span>
                                        <input class="uk-input uk-form-large" type="text" name="username" id="username" placeholder="Enter Username...">
                                       
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="lock"></span>
                                        <input class="uk-input uk-form-large" type="password" name="password" id="password" placeholder="Enter Password" minlength="6" maxlength="25"> 
                                    </div>
                                </div>
                                <div class="button-login">
                                    <button type="submit" name="sigIn" class="uk-button uk-button-secondary uk-button-large uk-width-1-1">Sign In</button>
                                </div>
                                <div class="uk-text-small  uk-text-center">
                                    Not registered? <a href="register.php" class="">Create an account</a>
                                </div>
                            </form>
                        </div>
                    </div> 
                    
                </div>  
            </div>
        </div>
    </div>  