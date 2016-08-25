<div class="admin_subnav">
    <ul>
        <li><a href="?page=locations">Pregled svih gradova</a> </li>
        <li><a href="?page=addlocation">Dodaj novu lokaciju</a> </li>

    </ul>
</div>


<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Ime</th>
        <th>Datum</th>
        <th>Obrisi</th>
        
    </tr>
    </thead>
    <tbody>
    <?php foreach($loc as $l){ ?>
        <tr>
            <td><?php echo $l['id'] ?></td>
            <td><?php echo $l['name'] ?></td>
            <td><?php echo $l['date'] ?></td>
            <td>
                <a href="?page=delete&action=location&location_id=<?php echo $l['id']?>">
                    Obrisi
                </a>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>