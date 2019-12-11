<?php
require_once '../config/config.php';

$db = getDbInstance();
$banners=$db->where('status','2')->orderBy('RAND()')->get('banners',10);
?>
<?php include BASE_PATH . '/frontend/includes/header.php'; ?>


    <div class="row">
        <?php foreach ($banners as $banner):?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="../<?php echo $banner['image'];?>" alt="..." style="width: 40%">
                    <div class="caption">
                        <h3><?php echo $banner['name'];?></h3>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>

<?php include BASE_PATH . '/frontend/includes/footer.php'; ?>
