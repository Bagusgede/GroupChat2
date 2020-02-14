<?php
    

    $userId   = $_SESSION['id'];
    $userPass = $_SESSION['password'];
    $userClass     = new UsersClass($pdo);
    // $messagesClass = new MessagesClass($pdo);

    $user      = $userClass->userData($userId);
    $listUsers = $userClass->list();

    // $fetchMessages = $messagesClass->fetch();

?>


<div class="col-md-4 col-xl-8 chat">

    <div class="card">
    <div class="card-body msg_card_body">
            <div class="mesgs">
                <p style="color: white;" class="text-center"></p>
            </div>
           




        <div class="card-header msg_head">
            <div class="d-flex bd-highlight">
                <li class="">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="bg1.jpg" class="rounded-circle user_img">
                        </div>
                        <div class="user_info">
                          <span>Skeensa KC</span>
                        </div>

                    </div>
                </li>
                <div class="video_cam uk-position-right">
                    <span><i class="fas fa-video"></i></span>
                    <span><i class="fas fa-phone"></i></span>
                </div>


            </div>
        </div>
       

            <!-- <?php
        // $i= 1;
        // if ($loadMessages):
        //     foreach ($loadMessages as $message):
        //         $fromUser = $classUsers->detail($message->user_from);
        //         $toUser   = $classUsers->detail($message->user_to);
                
    
        //         if ($message->user_from == $message->signin_user && $message->signin_user == $signInUser->id):
    ?> -->

            <!-- Class Mssages -->
            <div class="d-flex justify-content-end mb-4">
            <span></span>
                <div class="msg_cotainer">
                    <p>QWEQWE</p>
                    <span class="time_date" data-livestamp=""></span>

                </div>
                <div class="img_cont_msg">
                    <img src="bg1.jpg" class="rounded-circle user_img_msg">
                </div>
            </div>
            \
            <!-- <?php
        //  else:
?> -->

            <!-- Class Messages -->
            <div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg">
                    <img src="bg1.jpg" class="rounded-circle user_img_msg">
                </div>
                <div class="msg_cotainer">
                    <p>popopo</p>
                    <span class="time_date" data-livestamp=""></span>

                </div>
            </div>
            <!-- <?php
    //         $i++;
    //        endif;       
    //     endforeach;
    // endif;
        ?> -->

        </div>
        <form id="form-send-message" action="include/action/send-messages.php" method="post">
            <div class="card-footer">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                    </div>
                    <input type="hidden" value="" name="user_from">
                    <input type="hidden" value="" name="user_to">
                    <input type="hidden" value="" name="signin_user">
                    <input name="content" class="form-control type_msg" placeholder="Type your message..."
                        required></input>
                    <div class="input-group-append">
                        <button id="button-send-message" class="input-group-text send_btn" type="submit"><i
                                class="fas fa-location-arrow"></i></button>
                    </div>
                </div>
            </div>
        </form>

        <!-- <?php
//  endif;

?> -->
    </div>

</div>


<script>
    $(document).ready(function () {
        var form;
        $('#form-send-message').submit(function (event) {
            if (form) {
                form.abort();
            }

            form = $.ajax({
                url: 'include/action/send-messages.php',
                type: "POST",
                beforeSend: function () {
                    $('#button-send-message').prop("disabled", true);
                    $('#button-send-message').html(
                        '<i class="fa fa-circle-o-notch fa-spin"></i>');
                },
                data: $('#form-send-message').serialize(),
                cache: false,
            });

            console.log($('#form-send-message').serialize());

            form.done(function (data) {
                console.log(data);
                if (data == '1') {
                    // $('.msg_history').load('load_messages.php', {
                    //     from: '<?= $signInUser->id ?>',
                    //     to: '<?= $activeUser ?>'
                    // });
                    window.location.reload();
                } else {
                    alert('Error when sending message. Please refresh the page and try again.');
                }

                $('#button-send-message').prop("disabled", false);
                $('#button-send-message').html(
                    '<i class="fa fa-paper-plane-o" aria-hidden="true"></i>');
                $("#form-send-message").find('input[type=text]').val('');
            });

            form.always(function () {
                $("#form-send-message").find('input').prop("disabled", false);
                $("#form-send-message").find('buttton').prop("disabled", false);
            });

            event.preventDefault();
        })
    })
</script>