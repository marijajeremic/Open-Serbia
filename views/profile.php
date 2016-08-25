<div class="prof_cover">

<p class="title_prof">Dobrodosli <?php echo $_SESSION['name']?> !!!!!</p>

</div>
<div class="profil">
<?php
echo "<span class='font'>Ime: </span><span class='profi_text'>" . $_SESSION['name']. "</span><br>";
echo "<span class='font'>Email: </span><span class='profi_text'>" . $_SESSION['email']. "</span><br>";
echo "<span class='font'>Datum registracije: </span><span class='profi_text'>" . $_SESSION['date']. "</span><br>";
if(!empty($_SESSION['image'])){
    echo "<img class='prof' src='images/" . $_SESSION['image']. "'><br>";

}else{
    echo "<img class='prof' src='images/img.jpg'><br>";
}
?>
<form method="post" action="index.php?page=profile" enctype="multipart/form-data">
    <input type="file" name="file" >
    <button type="submit" name="submit">Dodaj sliku</button>
</form>

<?php




?>


<div class="prof_content">

<p></p>



</div>
</div>