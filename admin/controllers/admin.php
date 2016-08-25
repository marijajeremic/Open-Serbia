<?php

if($_GET['action']== 'post_approved'){
    $post= new Admin();
    $pos=$post->approvedPost($_GET['post_id']);
    header('Location: home.php?page=posts' );
}elseif($_GET['action'] == 'comm_approved'){
    $comm= new Comments();
    $comment=$comm->approvedComm($_GET['com_id']);
    header('Location: home.php?page=newcomments' );
}elseif ($_GET['action'] == 'add_admin'){
    $admins= new Admin();
    $admin = $admins->makeUserAdmin($_GET['user_id']);
    header('Location: home.php?page=users' );
}elseif ($_GET['action'] == 'off_admin'){
    $admins = new Admin();
    $admin=$admins->makeUserNoAdmin($_GET['user_id']);
    header('Location: home.php?page=users' );
}elseif($_GET['action'] == 'messages'){
    $mess=new Message();
    $m=$mess->readSiteMessage($_GET['id']);
    ?>
<table border="1">
    <thead>
    <tr>
       <th>Poruka</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $m['content'] ?></td>
        </tr>
    </tbody>
</table>
<?php
}
