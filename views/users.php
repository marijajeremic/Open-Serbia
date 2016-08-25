


<h2>Registrovani korisnici:</h2>


    <?php foreach($users as $u){?>
        <div class="users">

            <?php echo $u['name'] ?>
            <?php

            if(!empty($u['image'])){
                echo "<img class='prof_users' src='images/" . $u['image']. "'><br>";

            }else{
                echo "<img class='prof_users' src='images/img.jpg'><br>";
            }


            ?>
                <a href="?page=friends&action=addfriend&id=<?php echo $u['id']?>">Dodaj</a>

                 <a href="?page=fprofile&id=<?php echo $u['id'] ?>">Vidi profil</a>

</div>
    <?php } ?>
