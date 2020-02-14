<?php
    class MessagesClass
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }
        public function fetch()
        {
            $query = $this->pdo->query("SELECT a.*, b.* FROM messages a INNER JOIN users b ON a.sender = b.id ORDER BY a.created ASC");
            if($query->rowCount() > 0) {
                while($rows = $query->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }

            return false;
        }
        public function singleMessage($id) 
        {
            $query = $this->pdo->query("SELECT a.*, b.* FROM messages a INNER JOIN users b ON a.sender = b.id WHERE a.id = '$id'");
            if($query->rowCount() > 0) {
                $row = $query->fetch(PDO::FETCH_OBJ);
                return $row;
            }

            return false;
        }
        public function sendMessage($content, $sender)
        {
          
            $created = date('Y-m-d H:i:s');

            $result  = $this->pdo->prepare("INSERT INTO messages(
                content, 
                sender, 
                created) 
            VALUES (:content, :sender, :created)");
             
                $result->bindParam(':content',$content);
                $result->bindParam(':sender', $sender);
                $result->bindParam(':created', $created);


            if($result->execute()) {

                $lastId  = $this->pdo->lastInsertId();
                $message = $this->singleMessage($lastId);
                if ($message) {
                    $data = [
                        'id'         => $message->id,
                        'content'    => $message->content,
                        'sender'     => $message->sender,
                        'senderName' => $message->nickname,
                        'created'    => $message->created
                    ];

                    return $data;
                }
            }

            return false;
        }
    }
?>