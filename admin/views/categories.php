<div class="admin_subnav">
<ul>
    <li><a href="home.php?page=addcategory&action='add_category'">Dodaj novu kategoriju</a> </li>
    <li><a href="home.php?page=categories">Pregled kategorija</a> </li>
    

</ul>
</div>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Ime</th>
        <th>Kreator</th>
        <th>Datum</th>
        <th>Obrisi</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($cat as $c){ ?>
        <tr>
            <td><?php echo $c['category_id'] ?></td>
            <td><?php echo $c['category_name'] ?></td>
            <td><?php echo $c['creator'] ?></td>
            <td><?php echo $c['date'] ?></td>
            <td>
                <a href="?page=delete&action=category&category_id=<?php echo $c['category_id']?>">
                    Obrisi
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>