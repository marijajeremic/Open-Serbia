<h2>Izmeni :</h2>
<form method="POST" action="" enctype="multipart/form-data">
<select name="category_id">
    <option value="-1">Izaberi kategoriju:</option>

    <?php

    foreach ($category as $cat)
    {
        ?>
        <option value="<?php echo $cat['category_id'] ?>">
            <?php

            echo $cat['category_name'] . "<br>";
            ?>
        </option>
        <?php

    }
    ?>

</select>

<select name="id">
    <option value="-1">Izaberi lokaciju:</option>

    <?php

    foreach ($location as $loc)
    {
        ?>
        <option value="<?php echo $loc['id'] ?>">
            <?php

            echo $loc['name'] . "<br>";
            ?>
        </option>
        <?php

    }
    ?>

</select>


<br><br>
<input type="text" name="title" value=" <?php echo $post['title']   ;?>" placeholder="Unesite naslov..." class="title <?php echo (empty($errorArray['title']) ? '' : 'error');?>" >
<?php if (!empty($errorArray['title'])) { ?>
    <span ><?php echo $errorArray['title']; ?></span>
<?php } ?>

<br><br>
<textarea cols="100" rows="5" name="descript" placeholder="Unesite kraci opis..." class="descript <?php echo (empty($errorArray['descript']) ? '' : 'error');?>">
    <?php echo $post['descript']   ;?>
    </textarea>
<?php if (!empty($errorArray['descript'])) { ?>
    <span ><?php echo $errorArray['descript']; ?></span>
<?php } ?>

<textarea cols="150" rows="20" name="content" class="content <?php echo (empty($errorArray['content']) ? '' : 'error');?>">
<?php echo $post['content']   ;?>
    </textarea>
<?php if (!empty($errorArray['descript'])) { ?>
    <span ><?php echo $errorArray['descript']; ?></span>
<?php } ?>


<br><br>
<div class="form">

    <input type="file" name="file[]"  multiple="multiple">
</div>
<input type="submit" name="send" value="Send">
</form>