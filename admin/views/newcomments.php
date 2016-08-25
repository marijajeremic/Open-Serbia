<div class="admin_subnav">
    <ul>
        <li><a href="?page=comments">Svi komentari</a> </li>
        <li><a href="?page=newcomments">Neodobreni komentari </a> </li>

    </ul>
</div>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Korisnik</th>
        <th>Komentar</th>
        <th>Datum</th>
        <th>Post</th>
        <th>Status</th>
        <th>Vidi post</th>
        <th>Odobri komentar</th>
        <th>Obrisi komentar</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach($comment as $c){
        $users = new User();
        $user=$users->getUserById($c['id']);

        $posts= new Post();
        $post=$posts->getPostById($c['post_id']);
        ?>
        <tr>
            <td><?php echo $c['id'] ?></td>
            <td><?php echo $user['name'] ?></td>
            <td><?php echo $c['content'] ?></td>
            <td><?php echo $c['date'] ?></td>
            <td><?php echo $post['title'] ?></td>
            <td><?php echo $c['status'] ?></td>
            <td><a href="?page=post&post_id=<?php echo $c['post_id']?>">Procitaj post</a></td>
            <td><a href="?page=admin&action=comm_approved&com_id=<?php echo $c['id'] ?> ">Odobri</a></td>
            <td><a href="?page=delete&action=comm_delete&com_id=<?php echo $c['id'] ?> ">Obrisi</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>