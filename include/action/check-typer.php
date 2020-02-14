<?php

    require __DIR__ . '/../../vendor/autoload.php';
    require '../connection.php';
    require '../class/UserClass.php';

 $userClass = new UsersClass($pdo);

 $typer = trim($_POST['typer']);

 $userId = $userClass->userId($typer);

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

  $data['typer'] = $typer;
  $data['message'] = $userId->nickname . ' Sedang Belanja ';
  
  $pusher->trigger('my-chating', 'my-chating', $data);
?>