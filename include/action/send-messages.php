<?php
session_start();
 require __DIR__ . '/../connection.php';
 require __DIR__ . '/../class/MessagesClass.php';
 require __DIR__ . '/../../vendor/autoload.php';

 $messagesClass = new MessagesClass($pdo);

 $content = $_POST['message'];
 $sender = $_SESSION['id'];
 


 $sendMessages = $messagesClass->sendMessage($content, $sender);

 if($sendMessages){
   
  // header("Location:../../dashboard.php");
     $decode = $sendMessages;

     $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        '848f3d21f34d1ada170a',
        'bb84bbe1d38c93c3c6bd',
        '944981',
        $options 
      );

      $pusher->trigger('my-event','my-event', $decode);
 }

?>  