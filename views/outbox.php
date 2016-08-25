<?php


?>
<div class="messages">
    <h2>Poslate poruke:</h2>
<table border="1">
    <thead>
    <tr>


        <th>Primalac</th>
        <th>Email</th>
        <th>Naslov</th>
        <th>Poruka</th>
        <th>Obrisi</th>
        
    </tr>
    </thead>
    <tbody>
    <?php

    foreach ($messages as $msg){

        if ($msg['sender_id'] === $_SESSION['id']) {
            $userReciever = $user->getUserById($msg['reciever_id']);

        }
        ?>
        <tr>
            <td><?php echo $userReciever['name'] ?></td>
            <td><?php echo $userReciever['email'] ?></td>
            <td><?php echo $msg['title'] ?></td>

            <td>
                <a href="?page=read&action=msgreadoutbox&id=<?php echo $msg['id'] ?>">Procitaj</a>
            </td>
            <td>
                <a href="?page=delete&action=msg&id=<?php echo $msg['id']?>">Obrisi</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>