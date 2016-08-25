
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
    </tr>
    </thead>
    <tbody>
    <?php foreach($user as $r){ ?>
        <tr>
            <td><?php echo $r['id'] ?></td>
            <td><?php echo $r['name'] ?></td>
            <td><?php echo $r['email'] ?></td>
            <td><?php echo $r['date'] ?></td>
            <td><a href="?page=profile&user_id=<?php echo $r['id']?>">Vidi profil</a></td>
            <td><a href="?page=delete&action=delete_user&user_id=<?php echo $r['id']?>">Obrisi</a></td>
            <td><a href="?page=delete&action=block_user&user_id=<?php echo $r['id']?>">Blokiraj</a></td>
            <td><a href="?page=delete&action=unblock_user&user_id=<?php echo $r['id']?>">Odblokiraj</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>