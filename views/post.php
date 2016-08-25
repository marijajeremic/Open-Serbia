


<?php
foreach ($post as $pos) {
$a= json_decode($pos['post_img'],true);

?>
<div class="post">
    <div class='postimg'>
        <?php
        echo "<h2>" . $pos['title']. "</h2>";
        if (is_array($a)) {
            // foreach ($a as $imgLink) {


            echo "<img  class='post_img' src=\"images/post/{$a[0] }\" />";
            // }

        }
        ?>
    </div>
    <div class="posttext">
        <?php
        echo "<p>" . $pos['descript']. "</p>";
        ?>
        <div class="button"><a href="?page=readmore&post_id=<?php echo $pos['post_id']?>">Procitaj...</a></div>
        <div class="button"><a href="?page=edit&action=edit_post&post_id=<?php echo $pos['post_id']?>">Izmeni...</a></div>
            <div class="button">    <a href="?page=delete&action=delete_post&post_id=<?php echo $pos['post_id']?>">Obrisi...</a></div>
    </div>
    
    <?php
    }
    ?>

</div>