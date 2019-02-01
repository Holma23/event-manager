<table class="table table-striped">
    <tr><th>id</th><th>name</th><th>actions</th></tr>
    <?php foreach($results as $result) { ?>
    <tr>
        <td> <?php echo $result['id']?></td> <br>
        <td><?php echo $result['name']?>  </td>
        <td>
            <a
                    class="btn btn-danger"
                    href="index.php?module=event&action=cancelbooking&id=<?php echo $result['id']?>"> Annuler la réservation </a></td>


    </tr>
    <?php }?>
    </table>