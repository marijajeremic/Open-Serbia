<?php

?>

<div class="view">
   <span id="list"> <a class='maplist'  href="?page=home"><i class="fa fa-list" aria-hidden="true"></i>Lista</a></span>
   <span id="map"><a class='maplist' href="?page=maps"><i class="fa fa-map-marker" aria-hidden="true"></i>Mapa</a></span>
</div>
<div class="filters">

<form method="post" action="index.php?page=home">


        


        <select name="category_id" class="select">
            <option value="0">Izaberi kategoriju:</option>

            <?php

            foreach ($category as $cat)
            {
                ?>
                    <option value="<?php echo $cat['category_id'] ?>">
                        <?php echo $cat['category_name'] ?>
                    </option>
                <?php

            }
            ?>

        </select>

        <select name="id" class="select">
            <option value="0">Izaberi lokaciju:</option>

            <?php

            foreach ($location as $loc)
            {
                ?>
                    <option value="<?php echo $loc['id']?>">
                        <?php echo $loc['name'] ?>
                    </option>
                <?php

            }
            ?>

        </select>
    <input type="submit" name="submit" value="Filriraj"  class="filter"/>
</form>
</div>





        <?php
        foreach ($post as $pos) {
        $a= json_decode($pos['post_img'],true);

            ?>
            <div class="post" id="homepost">
                <div class="imageee">
                    <?php

                    if (is_array($a)) {
                       // foreach ($a as $imgLink) {


                                echo "<img  class='post_img' src=\"images/post/{$a[0] }\" />";
                           // }

                    }
                    ?>
                </div>

                <div class="posttext post-<?php echo $pos['post_id']?>" data-post-id="<?php echo $pos['post_id']?>"">
             <?php

             echo "<h2 class='home'>" . $pos['title']. "</h2>";
            echo "<p class='home'>" . $pos['descript']. " </p>";

             ?>
                    <a class="star" href="?page=home&action=rate&rate=1&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true"  id="star1"></i></a>
                    <a class="star" href="?page=home&action=rate&rate=2&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true" id="star2"></i></a>
                    <a class="star" href="?page=home&action=rate&rate=3&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true"  id="star3"></i></a>
                    <a class="star" href="?page=home&action=rate&rate=4&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true"  id="star4"></i></a>
                    <a class="star" href="?page=home&action=rate&rate=5&post_id=<?php echo $pos['post_id']?>"><i class="fa fa-star-o fa-lg stars" aria-hidden="true" id="star5"></i></a>

                    <span class="rating"> <?php echo $rating->returnRating($pos['post_id']) ?></span>

                    <div class="button" ><a href="?page=readmore&post_id=<?php echo $pos['post_id']?>">Saznaj vise...</a></div>

                </div>

            </div>

        <?php

        }
        ?>
<script type="text/javascript">

    // Ovo se pozove kad je dokument "spreman" tj kad se HTML ucita i prikaze
    $(document).ready(function () {

        // Ovo ce nam vratiti sve elemente koji imaju klasu "posttext"
        var posts = $('.posttext');

     
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
        var $stars = $('.posttext.post-' + postId).find('.star i');

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