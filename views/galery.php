



<form action="index.php?page=galery" method="post" enctype="multipart/form-data">
    <input type="file" name="file[]"  multiple="multiple">
    <input type="submit" name="submit">
</form>




<div class='galery_images' >
<?php
foreach($user as $us){
    echo "
    
   <img class='galery' src='images/" . $us['img_name']. "'>
    
    ";
}
?>
</div>