<?php if ($message) { ?>
<div class="alert alert-danger"><?php echo $message?></div>
<?php }?>

<form action="index.php?module=user&action=login" method="post">
    <input name="email" type="text" value="email" required /><br />
    <input name="password" type="password" value="password" required /><br />
    <input name="is_sent" value="1" type="hidden" />
    <button type="submit">Se connecter</button>
</form>