
<?php

?>
<h2>Zahtevi za prijateljstvo:</h2>
<table border="1">
    <thead>
    <tr>

        <th>Ime</th>
        <th>Vidi profil</th>

        <th>Prihvati/Ignorisi</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach($friendRequests as $f){
var_dump($f);
    $users = new User();
    $user = $users->getUserById($f['sender_id']);

    ?>
        <tr>

            <td><?php echo $user['name'] ?></td>
            <td><a href="?page=fprofile&id=<?php echo $user['id'] ?>">Vidi profil</a></td>

            <td>
                <a href="?page=friends&action=accept&id=<?php echo $f['id']?>">Prihvati</a>/
                <a href="?page=friends&action=ignore&id=<?php echo $f['id'] ?>">Ignorisi</a>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>

<h2>Prijatelji:</h2>


    <?php foreach($myfriends as $f){
        ?>
        <div class="users">
            <?php
        $users= new User();
        if ($f['user_id'] === $_SESSION['id']) {
            $userData = $users->getUserById($f['friend_id']);
        } else {
            $userData = $users->getUserById($f['user_id']);


        }
        ?>


            <?php echo $userData['name'] ?>
          <?php echo $userData['email'] ;

            if(!empty($userData['image'])){
            echo "<img class='prof_users' src='images/" . $userData['image']. "'><br>";

            }else{
            echo "<img class='prof_users' src='images/img.jpg'><br>";
            }
           ?>

                <a href="?page=fprofile&id=<?php echo $userData['id'] ?>">Vidi profil</a>

                <a href="?page=delete&action=del_friend&user_id=<?php echo $userData['id'] ?>">Obrisi prijatelja</a>
       </div>
    <?php } ?>


