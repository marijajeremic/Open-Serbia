

<div class="info">
    <h2>Dobrodosli na moj profil.</h2>
<?php

echo "<span class='font'>Ime: </span><span class='profi_text'>" . $user['name']. "</span><br>";
echo "<span class='font'>Datum registracije: </span><span class='profi_text'>" . $user['date']. "</span><br>";
if(!empty($user['image'])){
    echo "<img class='imgfprof' src='images/" . $user['image']. "'><br>";

}else{
    echo "<img class='imgfprof' src='images/img.jpg'><br>";
}
//var_dump($posts);
?>
</div>
    <div class="user_post">

<?php
foreach ($posts as $pos){
    echo $pos['title']."<br>";
    $a= json_decode($pos['post_img'],true);
    if (is_array($a)) {


        echo "<img  class='post_img' src=\"images/post/{$a[0] }\" />";


    }

    echo $pos['descript']."<br>";
    ?>
    <a href="?page=readmore&post_id=<?php echo $pos['post_id']?>">Procitaj...</a><br>
    </div>
<?php
}
