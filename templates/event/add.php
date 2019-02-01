<?php if($message){ ?>
<div class="alert alert-danger">{{ message }}</div>
<?php }?>
<div class="container">
    <div class="row justify-content-md-center">

        <div class="col-md-10">
            <form  enctype="multipart/form-data" action="index.php?module=event&action=add" method="post">
                <h3>Ajouter un évenement</h3>

                <div class="form-group">
                    <input class="form-control" type="text" name="name" value="<?php echo $name ?>" placeholder="name" >
                </div>
                <div class="form-group">
                    <input class="form-control" multiple type="file" name="image[]">
                </div>
                <div class="form-group">
                    <select class="form-control" name="topic_id">
                        <option value="">ChoisirTopic</option>
                        <?php foreach ($topics as $topic){?>
                            <option <?php echo $topic['id'] ==$topicId?"selected":"" ?> value="<?php echo $topic['id']?>">
                                <?php echo $topic['name']?>
                            </option>
                        <?php }?>
                    </select>
                </div>

                <div class="form-group">
                    <input class="form-control" type="date" name="begin_at" placeholder="begin at" >
                </div>

                <div class="form-group">
                    <input class="form-control" type="date" name="end_at" placeholder="end at" >
                </div>

                <div class="form-group">
                    <input class="form-control" type="number" name="max_place" placeholder="max place" >
                </div>

                <input type="hidden" name="is_sent" value="1">

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
