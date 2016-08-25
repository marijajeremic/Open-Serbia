<div class="post post-<?php echo $pos['post_id']?>" data-post-id="<?php echo $pos['post_id']?>"">


        <?php
        echo "<h2>" . $pos['title']. "</h2>";
        ?>
    <a class="star" href="?page=home&action=rate&rate=1&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true"  id="star1"></i></a>
    <a class="star" href="?page=home&action=rate&rate=2&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true" id="star2"></i></a>
    <a class="star" href="?page=home&action=rate&rate=3&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true"  id="star3"></i></a>
    <a class="star" href="?page=home&action=rate&rate=4&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true"  id="star4"></i></a>
    <a class="star" href="?page=home&action=rate&rate=5&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true" id="star5"></i></a>

    <span class="rating"> <?php echo $rating->returnRating($pos['post_id']) ?></span>


        
        <?php

        echo "<p>" . $pos['descript']. "</p>";
        echo"<img  class='post_img_1' src=\"images/post/{$a[0]}\" />";
        echo "<p>" . $pos['content']."</p>";
        if (is_array($a)) {
            foreach ($a as $imgLink) {
                echo "<img  class='post_img' src=\"images/post/{$imgLink}\" />";
            }
        }
            ?>
</div>
    <div class="comments">
        <button onclick="commentform()">Ostavite komentar</button>

        <form method="post" action="?page=readmore&action=comment&post_id=<?php echo $pos['post_id']?>" id="commentform">
        <textarea class="comment" name="content" cols="100" rows="7">

        </textarea><br><br>
        <input type="submit"    name="send" value="Posalji">
        </form>
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


        <?php }} }?>
<script type="text/javascript">
    $(document).on('click', 'a.comment-comment', function (event) {
        event.preventDefault();

        var commentId = $(this).data('comment-id');

       $('form.comment-' + commentId).toggle();
    });

    document.getElementById("commentform").style.display="none";
    function commentform()
    {
        document.getElementById("commentform").style.display="block";

    }

    document.getElementById("comment").style.display=''

    // Ovo se pozove kad je dokument "spreman" tj kad se HTML ucita i prikaze
    $(document).ready(function () {

        // Ovo ce nam vratiti sve elemente koji imaju klasu "posttext"
        var posts = $('.post');

        // .each je iteracija kroz niz
        // i odnosi se na niz iz kojeg se poziva
        posts.each(function (index, post) {
            // index nam je key
            // post nam je HTML element koji sadrzi informacije (text, sliku, rating...)

            // .data je metoda u jQuery koja parsira html atribute koji pocinju sa "data-"
            // u nasem slucaju $(post).data('post-id') uzima vrednost atributa data-post-id iz trenutnog elementa
            var id = $(post).data('post-id');

            // .find je jquery metoda koja trazi odredjeni selektor u zadatom elementu
            // u nasem slucaju trazimo "span.rating" koji se nalazi u trenutnom ".posttext" elementu koji obradjujemo
            var rating = $(post).find('span.rating').text();

            // Pozivamo funkciju :)
            // parseFloat ce da pokusa da pretvori "string" u "float"
            setRating(id, parseFloat(rating));
        });
    });

    var setRating = function (postId, rating) {
        // zamislimo da je postId = 1
        // $start varijabla ce da drzi sve elemente koji imaju klasu "star" tip su "i" i nalaze se unutar  "posttext" i "post-1" (1 posto smo to dali ka primer)
        var $stars = $('.post.post-' + postId).find('.star i');

        // Zaokruzujemo decimalni broj na najblizi celi broj
        rating = Math.round(rating);

        $stars
        // Uklanjamo klasu "fa-star"  sa svih ".star i" elemenata - to je ona popunjena zvezdica
            .removeClass('fa-star')
            // Dodajemo klasu "fa-star-o"  sa sve ".star i" elemenate - to je ona prazna zvezdica
            .addClass('fa-star-o');

        for (var i = 0; i < rating; i++) {
            // Ovo je isto sto i gore, samo se odnosi na jedan element sto je naglaseno sa "[i]"
            $($stars[i])
                .removeClass('fa-star-o')
                .addClass('fa-star')
                .css('color', 'gold');
        }
    };

    // Slusamo "click" dogadjaj na svim "a" elementima sa klasom "star"
    $(document).on('click', 'a.star', function (event) {

        // Sprecavamo pretrazivac da odradi podrazumevanu radnju tj da ode direktno na taj link
        event.preventDefault();

        // .attr(key, value) ukoliko ima samo jedan parametar vraca vrednost trazenog atributa u zeljenom elementu
        // this se odnosi na "a" tag na koji smo kliknuli, i time ce ovo vratiti atribut "href" od elementa na koji je kliknuto
        var url = $(this).attr('href');

        // .siblings vraca elemente koje imaju zadati selektor i nalaze se u istom HTML elementu gde se nalazi trenutni
        // u istom u parentu
        var ratings = $(this).siblings('span.rating').get(0);

        // Objekat -.-'
        var param = {
            // Putanja na koju saljemo AJAX poziv
            url: url,
            // Metoda kojom pozivamo
            type: 'GET',
            // Tip vracenih podataka od servera, ukoliko jQuery ne bude mogao da parsira response, tj da ga pretvori u
            // json objekat, metoda success se nece pozvati
            dataType: 'json',
            // Metoda koja se poziva ako je poziv zavrsio uspesno
            success: function (response) {
                var success = response.success || false;

                if (false === success) {
                    alert(response.message);

                    return;
                }

                var postId = parseInt(response.postId);

                var rating = parseFloat(response.rating);

                if (isNaN(rating)) {
                    alert('Nije uspesno!');

                    return;
                }

                setRating(postId, rating);

                $(ratings).html(rating);
            }
        };

        // $.ajax je jQuery metoda koja startuje ajax upit
        $.ajax(param);
    });
</script>

