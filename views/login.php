<?php

?>
<div class="bigbox">
<div class="box">
    <div class="login">
<h2>Ulogujte se:</h2>

<form method="POST" action="index.php?page=login">
    <div class="form">
        <label for="Email">Email</label><br>

        <input type="email" class="form-control <?php echo (empty($errorArray['email']) ? '' : 'error');?>" name="email" placeholder="Email" />
        <?php if (!empty($errorArray['email'])) { ?>
            <span ><?php echo $errorArray['email']; ?></span>
        <?php } ?>
    </div>
    <div class="form">
        <label for="Password">Lozinka</label><br>
        <input type="password" class="form-control <?php echo (empty($errorArray['password']) ? '' : 'error');?>" name="password" placeholder="Password" />
        <?php if (!empty($errorArray['password'])) { ?>
            <span ><?php echo $errorArray['password']; ?></span>
        <?php } ?>
    </div>
    <button type="submit" name="submit" class="">Potvrdi</button>
</form>
</div>

   
    </div>
</div>