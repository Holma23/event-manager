<?php if ($message) { ?>
    <div class="alert alert-info"><?php echo $message?></div>
<?php }?>
<form method="post" action="index.php?module=user&action=signup">
<input name="name" type="text" required  placeholder="name"><br><br>
<input name="email" type="text" required  placeholder="email"><br><br>
<input name="password" type="password" required  placeholder="password"><br><br>
<input name="age" type="number" required  placeholder="age"><br><br>
<input name="sent" type="hidden" value="1">
<button type="submit">Enregistrer</button>

</form>