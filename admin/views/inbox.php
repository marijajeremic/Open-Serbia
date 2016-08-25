<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Korisnik</th>
        <th>Email</th>
        <th>Naslov</th>
        <th>Datum</th>
        <th>Procitaj</th>


    </tr>
    </thead>
    <tbody>
    <?php foreach($message as $m){

        ?>
        <tr>
            <td><?php echo $m['id'] ?></td>
            <td><?php echo $m['name'] ?></td>
            <td><?php echo $m['email'] ?></td>
            <td><?php echo $m['title'] ?></td>
            <td><?php echo $m['date'] ?></td>
            <td><a href="?page=admin&action=messages&id=<?php echo $m['id']?>">Procitaj</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>