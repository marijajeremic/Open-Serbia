<div class="post post-<?php echo $pos['post_id']?>" data-post-id="<?php echo $pos['post_id']?>"">


        <?php
        echo "<h2>" . $pos['title']. "</h2>";
    
       echo "<p>" . $pos['descript']. "</p>";
        echo"<img  class='post_img_1' src=\"../images/post/{$a[0]}\" />";
        echo "<p>" . $pos['content']."</p>";
        if (is_array($a)) {
            foreach ($a as $imgLink) {
                echo "<img  class='post_img' src=\"../images/post/{$imgLink}\" />";
            }
        }
            ?>
</div>
    <div class="comments">
        <button onclick="commentform()">Ostavite komentar</button>


        <?php
            foreach ($comm as $c){
                
                ?>
        <div class="comments" id="comment">
            <?php
                $user=new User();
                $users=$user->getUserById($c['user_id']);
                $userData=$users['name'] .":" ;

                echo '<span class="name">'. $userData .'</span>';
                echo  '<span class="date">'.$c['date']. "</span><br><br>";
                echo '<span class="cont">'.$c['content']. "</span><br>";

            ?>

            <a class="comment-comment" data-comment-id="<?php echo $c['id'] ?>" href="#"> Odgovori na komentar</a><br>

            <form class="comment hide comment-<?php echo $c['id'] ?>" action="?page=readmore&action=commentsc&post_id=<?php echo $pos['post_id']?>&comment_id=<?php echo $c['id'] ?>" method="post">
                <textarea name="comment"></textarea>
                <button type="submit" name="submit">Odgovori</button>
            </form>
    </div>

                    <?php
                    $comcom= new Comments();
                    $res=$comcom->commOfComm($c['post_id'],$c['id']);
            if(!empty($res)){
                    foreach ($res as $r){
                        ?>
                        <div class="comments" id="comofcom">
                        <?php
                        echo '<span class="name">'. $userData .'</span>';
                        echo  '<span class="date">'.$r['date']. "</span><br><br>";
                        echo '<span class="cont">'.$r['content']. "</span><br>";
                        echo "<br>";

                    ?>
                </div>


        <?php }}} ?>