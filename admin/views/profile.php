<div class="prof_user">

<div class="bigbox">
<div class="box">
<?php
echo "<span class='font'>Ime: </span><span class='profi_text'>" . $user['name']. "</span><br>";
echo "<span class='font'>Email: </span><span class='profi_text'>" . $user['email']. "</span><br>";
echo "<span class='font'>Datum registracije: </span><span class='profi_text'>" . $user['date']. "</span><br>";
if(!empty($user['image'])){
    echo "<img class='imgfprof' src='../images/" . $user['image']. "'><br>";

}else{
    echo "<img class='imgfprof' src='../images/img.jpg'><br>";
}

?>
</div>
</div>
</div>