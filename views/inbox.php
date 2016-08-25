
<h2>Posaljite poruku:</h2>
<form method="post" action="index.php?page=inbox" >


    <select name="reciever">
        <option value="0">Primalac:</option>

        <?php

        foreach ($users as $u)
        {
            ?>
            <option value="<?php echo $u['id'] ?>">
                <?php echo $u['name'] ?>
            </option>
            <?php

        }
        ?>

</select>

<p>Naslov</p><input type="text" name="title"><br>
<p>Poruka:</p><textarea cols="100" rows="10" name="content"></textarea><br>
<input type="submit" name="send" value="Send">
</form>

<div class="messages">
    <h2>Primljene poruke:</h2>
<table border="1">
    <thead>
    <tr>

        <th>Ime</th>
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
        $userData = $user->getUserById($msg['reciever_id']);
    } else {
        $userData = $user->getUserById($msg['sender_id']);


    }

        ?>
        <tr>

            <td><?php echo $userData['name'] ?></td>
            <td><?php echo $userData['email'] ?></td>
            <td><?php echo $msg['title'] ?></td>

            <td>
                <a href="?page=read&action=msgreadinbox&id=<?php echo $msg['id'] ?>">Procitaj</a>
            </td>
            <td>
                <a href="?page=delete&action=msgr&id=<?php echo $msg['id'] ?>">Obrisi</a>
            </td>
        </tr>
        <?php

}
?>
    </tbody>
</table>
    
</div>
<?php



?>





