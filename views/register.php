<div class="bigbox">
<div class="box">

    <div class="register">
<h2>Registrujte se:</h2>

<form method="post" action="index.php?page=register" enctype="multipart/form-data">
    <div class="form">
        <label for="name">Ime:</label><br>
        <input type="text" class="form-control <?php echo (empty($errorArray['name']) ? '' : 'error');?>" name="name" placeholder="Name">
        <?php if (!empty($errorArray['name'])) { ?>
            <span id="helpBlock2" class="help-block"><?php echo $errorArray['name']; ?></span>
        <?php } ?>
    </div>
    <div class="form">
        <label for="exampleInputEmail1">Email </label><br>
        <input type="email" class="form-control <?php echo (empty($errorArray['email']) ? '' : 'error');?>"name="email" placeholder="Email">
        <?php if (!empty($errorArray['email'])) { ?>
            <span id="helpBlock2" class="help-block"><?php echo $errorArray['email']; ?></span>
        <?php } ?>
    </div>
    <div class="form">
        <label for="exampleInputPassword1">Lozinka</label><br>
        <input type="password" class="form-control <?php echo (empty($errorArray['password']) ? '' : 'error');?>" name="password" placeholder="Password">
        <?php if (!empty($errorArray['password'])) { ?>
            <span id="helpBlock2" class="help-block"><?php echo $errorArray['password']; ?></span>
        <?php } ?>
    </div>
    <div class="form">
        <input type="file" name="file" >

    </div>


    <button type="submit" name="submit" class="btn btn-default">Posalji</button>
</form>
        </div>
</div>
</div>