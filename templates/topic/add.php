<h3>Ajouter un topic</h3>
<form enctype="multipart/form-data"
        action="index.php?module=topic&action=add" method="post">
    <input type="text" name="name"><br />
    <input  type="file" name="image"><br />
    <button type="submit">Ajouter</button>
    <input type="hidden" name="is_sent" value="1">
</form>