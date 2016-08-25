<?php if($admin['admin'] == 1) { ?>
<div class="admin_subnav">
    <ul>
        <li><a href="home.php?page=addcategory&action='add_category'">Dodaj novu kategoriju</a> </li>
        <li><a href="home.php?page=categories">Pregled kategorija</a> </li>

    </ul>
</div>
    <div class="prof_user">

        <div class="bigbox">
            <div class="box">
 <h2>Dodaj novu kategoriju:</h2>
<form action="" method="post"    >
<input type="text" name="category_name" placeholder="Ime kategorije" class="input">
<button type="submit" name="new_category" class="filter">Dodaj</button>
</form>
</div>
            </div>
        </div>
<?php } ?>