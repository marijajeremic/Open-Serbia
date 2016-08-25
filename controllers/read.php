<?php


if($_GET['action'] == 'msgreadinbox') {
    $message = new Message();
    $msg = $message->readMessage($_GET['id']);

    $user = new User();
    $us = $user->getUserById($msg['sender_id']);

    ?>
    <div class='msg'>
        <?php
        echo "<p class='message'>" . $msg['content'] . "</p>";
        ?>
    </div>
    <form method="post" action="" >



        <p>Odgovori:</p><textarea cols="100" rows="10" name="content"></textarea><br>
        <input type="submit" name="send" value="Send">
    </form>
    <?php


    if(isset($_POST['send'])) {


        $sender_id = $_SESSION['id'];
        $reciever_id = $msg['sender_id'];
        $title = "RE:" . $msg['title'];
        $content = $_POST['content'];


        if ($message->sendMessage($sender_id, $reciever_id, $title, $content)) {
            echo "Uspesno ste ogovorili na poruku.";
        } else {
            echo "Neuspesno .";
        }


    }
}

elseif($_GET['action'] == 'msgreadoutbox'){
    $message = new Message();
    $msg=$message->getMessage($_GET['id']);
?>
<div class='msg'>
        <?php
        
        echo "<p class='message'>" . $msg['content'] . "</p>";
        ?>
</div>
<?php
}


include __DIR__ . '/../views/read.php';