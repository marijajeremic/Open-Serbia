<div class="admin_subnav">
    <ul>
        <li><a href="home.php?page=users">Pregled svih korisnika</a> </li>
        <li><a href="home.php?page=onlineusers">Pregled online korisnika</a> </li>
        <li><a href="home.php?page=offlineusers">Pregled offlinekorisnika</a> </li>
        <li><a href="home.php?page=blockedusers">Pregled blokiranih profila</a> </li>

    </ul>
</div>



<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Ime</th>
        <th>Email</th>
        <th>Datum</th>
        <th>Vidi profil</th>
        <th>Obrisi</th>
        <th>Blokiraj</th>
        <th>Odlokiraj</th>
        <th>Status</th>
        <th>Privilegije</th>
        <?php
        if($_SESSION['superadmin'] == 1){
            ?>
            <th>Dodaj admina</th>
        <?php
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach($res as $r){ ?>
        <tr>
            <td><?php echo $r['id'] ?></td>
            <td><?php echo $r['name'] ?></td>
            <td><?php echo $r['email'] ?></td>
            <td><?php echo $r['date'] ?></td>
            <td><a href="?page=profile&user_id=<?php echo $r['id']?>">Vidi profil</a></td>
            <td><a href="?page=delete&action=delete_user&user_id=<?php echo $r['id']?>" " >Obrisi</a></td>
            <td><a class='block ' href="?page=delete&action=block_user&user_id=<?php echo $r['id']?>" data-user-id="<?php echo $r['id']?> ">Blokiraj</a></td>
            <td><a  class='unblock' href="?page=delete&action=unblock_user&user_id=<?php echo $r['id']?>">Odblokiraj</a></td>
            <td>
                <?php
                if($r['is_blocked'] == 1){
                    echo "<p class='blocked'>Blokiran</p>";
                }elseif($r['is_logged'] == 1){
                    echo "<p class='online'>Online</p>";
                }elseif($r['is_logged'] == 0){
                    echo "<p class='offline'>Offline</p>";
                }
                ?>
            </td>
            <td>
                <?php
                if($r['admin'] == 0){
                    echo "<p class='offline'>Korisnik</p>";
                }elseif($r['admin'] == 1 && $r['superadmin'] ==0){
                    echo "<p class='online'>Admin</p>";
                }elseif($r['admin'] == 1 && $r['superadmin'] ==1){
                    echo "<p class='blocked'>Superadmin</p>";
                }
                ?>
                <?php
                if($_SESSION['superadmin'] == 1){
                ?>

            <td><a href="?page=admin&action=add_admin&user_id=<?php echo $r['id'] ?>">Dodaj</a>/<a href="?page=admin&action=off_admin&user_id=<?php echo $r['id'] ?>">Izbaci</a></td>
            <?php
            }
            ?>
        </tr>
    <?php } ?>
    </tbody>
</table>


