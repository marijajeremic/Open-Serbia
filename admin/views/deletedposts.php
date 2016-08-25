<div class="admin_subnav">
    <ul>
        <li><a href="?page=posts">Svi postovi</a> </li>
        <li><a href="?page=newposts">Neobjavljeni postovi </a> </li>
        <li><a href="?page=deletedposts">Obrisani postovi </a> </li>
    </ul>
</div>


<?php
$usersData = [];
?>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Naslov</th>
        <th>Datum</th>
        <th>Korisnik</th>
        <th>Kategorija</th>
        <th>Lokacija</th>
        <th>Status</th>
        <th>Procitaj</th>
        <th>Obrisi trajno</th>
        

    </tr>
    </thead>
    <tbody>
    <?php foreach($posts as $p){

        if (empty($usersData[$p['user_id']])) {
            $usersData[$p['user_id']] = $user->getUserById($p['user_id']);
        }

        $userData = $usersData[$p['user_id']];

        $categoryData = $category->getCategoryByCategoryId($p['id_category']);
        $locationData = $category->getLocationByLocationId($p['id_place']);
        ?>
        <tr>
            <td><?php echo $p['post_id'] ?></td>
            <td><?php echo $p['title'] ?></td>
            <td><?php echo $p['date'] ?></td>
            <td><?php echo $userData['name'] ?></td>
            <td><?php echo $categoryData['category_name'] ?></td>
            <td><?php echo $locationData['name'] ?></td>
            <td><?php echo $p['admin_approved'] ?></td>
            <td><a href="?page=post&post_id=<?php echo $p['post_id']?>">Procitaj post</a></td>
            <td><a href="?page=delete&action=delete_post&post_id=<?php echo $p['post_id']?>">Obrisi trajno</a></td>
            
        </tr>
    <?php } ?>
    </tbody>
</table>