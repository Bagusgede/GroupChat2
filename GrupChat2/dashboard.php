<!------ Include the above in your HEAD tag ---------->

<?php
session_start();
if(empty($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'include/connection.php';
require 'include/class/UserClass.php';
require 'include/class/MessagesClass.php';



$userClass = new UsersClass($pdo);

$messagesClass = new MessagesClass($pdo);


    $listUsers = $userClass->list($_SESSION['id']);
    $dataUser = $userClass->loginUser($_SESSION['id']);
    $cover = $dataUser->cover;
    $name = $dataUser->nickname;

    $fetchMessages = $messagesClass->fetch();



?>


<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
    <link rel="stylesheet" href="css/uikit.min.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <style>
        body {
            overflow: hidden;
        }

        .foto {
            -webkit-filter: brightness(35%);
        }
    </style>
</head>
<!--Coded With Love By Mutiullah Samim-->

<body>
    <img src="bg1.jpg" class="foto" alt="">
    <div class="uk-position-center" style=" width: 200%; ">

        <div class="container-fluid h-100 uk-animation-fade">
            <div class="row justify-content-center h-100 ">

                <div class="col-md-4 col-xl-8 chat">

                    <div class="card">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <li class="">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="bg1.jpg" class="rounded-circle user_img">
                                        </div>
                                        <div class="user_info">
                                            <span>Skeensa KC</span>
                                            <p id="bind-typing">You,<?php
                        $i = 1;
                        $total = count($listUsers);
                        $sisa = $total - 3 ;
                        foreach ($listUsers as $list) {

                            if($i == 1 || $i == 2 || $i == 3) {

                            echo $list->nickname .', ';
                        }
                        $i++;
                    }
                        
                        echo ' dan ' . $sisa . ' others member ';
                      ?>
                                            </p>
                                        </div>

                                    </div>

                                    </ul>
                            </div>
                            </li>

                            <div class="video_cam uk-position-center-right uk-padding">
                                <span><i class="fas fa-video"></i></span>
                                <span><i class="fas fa-phone"></i></span>
                                <span uk-icon="icon:more-vertical" style="color:white" class=" "></span>
                                <div uk-dropdown>
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li class="" style="font-family:'Poppins', sans-serif; font-size:15px;"><img
                                                src=" <?php echo  "assets/cover/".$cover; ?> "
                                                class="rounded-circle user_img_msg" alt=""><b><?= $name; ?></b> </li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div>


                            </div>
                        </div>
                        <div id="load-messages" class="card-body msg_card_body">
                            <div class="mesgs">
                                <p style="color: white;" class="text-center"></p>
                            </div>






                            <?php
        if ($fetchMessages):
            foreach ($fetchMessages as $message):
                if ($message->sender == $_SESSION['id']):
       ?>

                            <!-- Class Mssages -->
                            <div class="d-flex justify-content-end mb-4">
                                <span></span>
                                <div class="msg_cotainer">
                                    <h4 class="non-uikit" align="right"><?= $message->nickname ?></h4>
                                    <p><?= $message->content ?></p>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="<?php echo "assets/cover/". $cover;?>"
                                        class="rounded-circle user_img_msg">
                                </div>
                            </div>

                            <?php
     else:
?>

                            <!-- Class Messages -->
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="<?php echo "assets/cover/". $message->cover;?>"
                                        class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer ">
                                    <h4 class="non-uikit" align="left"><?= $message->nickname ?></h4>
                                    <p><?= $message->content ?></p>

                                </div>
                            </div>
                            <?php
      
       endif;       
    endforeach;
endif;

    ?>

                        </div>
                        <form id="form-send-message" action="include/action/send-messages.php" method="post">
                            <div class="card-footer">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text attach_btn"><i
                                                class="fas fa-paperclip"></i></span>
                                    </div>

                                    <input id="message" name="message" class="form-control type_msg"
                                        placeholder="Type your message..." required autofocus></input>
                                    <div class="input-group-append">
                                        <button id="button-send-message" class="input-group-text send_btn"
                                            type="submit"><i class="fas fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>


                <script>
                    $(document).ready(function () {

                        $('#load-messages').animate({
                            scrollTop: $('#load-messages')[0].scrollHeight + 1000
                        }, "slow");

                        var form;
                        $('#form-send-message').submit(function (event) {
                            var targetForm = $(this),

                                // Guna $(this) = sesuatu yang menjadi target function 

                                url = targetForm.attr('action'),
                                // attr = Atribut contoh = Di dalam form tu ada "action" ada "method" sama "id"
                                submit = targetForm.find('#button-send-message');

                            // variabel pengganti submit "find" cari elemen yang ada di dalem target tersebut

                            if (form) {
                                form.abort();
                            }

                            form = $.ajax({
                                url: url,
                                type: "POST",
                                beforeSend: function () {},
                                data: targetForm.serialize(),
                                // contentType: false,
                                cache: false,
                                // processData:false
                            });

                            form.done(function (data) {
                                console.log(data);
                                targetForm.find('input').val('');
                                // untuk load data
                                // $('#load').html(data);
                                // untuk refresh halaman
                                // window.location = 'dashboard.php';
                            });

                            form.always(function () {
                                targetForm.find('input').prop("disabled", false);
                                targetForm.find('select').prop("disabled", false);
                                targetForm.find('textarea').prop("disabled", false);
                            });

                            event.preventDefault();
                        })
                    })
                </script>
                <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
                <script>
                    // Enable pusher logging - don't include this in production
                    Pusher.logToConsole = true;

                    var pusher = new Pusher('848f3d21f34d1ada170a', {
                        cluster: 'ap1',
                        forceTLS: true
                    });

                    var anggota = $('#bind-typing').html();
                    var channelTyping = pusher.subscribe('my-chating');
                    channelTyping.bind('my-chating', function (data) {
                        var userId = '<?=$_SESSION['id']?>';

                        if (userId != data.typer) {

                            $('#bind-typing').html(data.message);
                            setTimeout(() => {
                                $('#bind-typing').html(anggota);
                            }, 3000);

                        }

                    });
                    $('#message').keyup(function () {

                        var typer = '<?=$_SESSION['id']?>';

                        $.ajax({
                            type: "POST",
                            url: 'include/action/check-typer.php',
                            data: {
                                typer: typer
                            },
                            cache: false,
                            beforeSend: function () {},
                            success: function (data) {}
                        })
                    });


                    var channelTyping = pusher.subscribe('my-event');
                    channelTyping.bind('my-event', function (data) {

                        var typer = '<?= $_SESSION['id'] ?>';
                        var response = (JSON.stringify(data));
                       
                        if (typer == data.sender) {

                            var chat =
                                '<div class="d-flex justify-content-end mb-4"> <span></span> <div class="msg_cotainer"> <h4 class="non-uikit" align="right">' +
                                data.senderName + '</h4> <p>' + data.content +
                                '</p></div><div class="img_cont_msg"> <img src="bg1.jpg" class="rounded-circle user_img_msg"> </div></div>';

                        } else {
                            $('title').html('New Message From ' + data.senderName);
                            var chat =
                                '<div class="d-flex justify-content-start mb-4"> <div class="img_cont_msg"> <img src="bg1.jpg" class="rounded-circle user_img_msg"> </div><div class="msg_cotainer "> <h4 class="non-uikit" align="left">' +
                                data.senderName + '</h4> <p>' + data.content + '</p></div></div>';

                            var myAudio = document.createElement('audio');
                            if (myAudio.canPlayType('audio/mpeg')) {
                                myAudio.setAttribute('src', 'assets/audio/ringtone.mp3');
                            }
                            myAudio.play();
                        }

                        $('#load-messages').append(chat);
                        $('#load-messages').animate({
                            scrollTop: $('#load-messages')[0].scrollHeight + 1000
                        }, "slow");
                        setTimeout(() => {
                            $('title').html('New Chat  -  Let\'s Chat');
                        }, 3000);



                    });
                </script>

            </div>

        </div>

    </div>

</body>

</html>