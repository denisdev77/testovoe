<?php
$opt_arr = [
        1 =>'Disabled',
        2 =>'Active'
];
?>
<fieldset>
    <div class="form-group">
        <label for="name">Name *</label>
          <input type="text" name="name" value="<?php echo htmlspecialchars($edit ? $banner['name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Name banners" class="form-control" required="required" id = "name">
    </div> 

    <div class="form-group">
        <label for="type">Type *</label>
        <input type="text" name="type" value="<?php echo htmlspecialchars($edit ? $banner['type'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Type" class="form-control" required="required" id="type">
    </div>

    <div class="form-group">
        <label for="address">Url</label>
        <input type="text" name="url" placeholder="Url" class="form-control" id="url" value="<?php echo htmlspecialchars(($edit) ? $banner['url'] : '', ENT_QUOTES, 'UTF-8'); ?>">
    </div>

    <div class="form-group">
        <label for="target">Target</label>
          <input type="text" name="target" placeholder="Target" class="form-control" id="target" value="<?php echo htmlspecialchars(($edit) ? $banner['target'] : '', ENT_QUOTES, 'UTF-8'); ?>">
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control selectpicker" required>
            <option value=" ">Please select status</option>
            <?php foreach ($opt_arr as $key => $opt) {
                if ($edit && $key == $banner['status']) {
                    $sel = 'selected';
                } else {
                    $sel = '';
                }
                echo '<option value="'. $key .'"' . $sel . '>' . $opt . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
        <?php if(empty($banner['image'])):?>
            <img src="assets/img/not-available.png" alt="not-image" style="width: 25%">
        <?php else:?>
            <input type="text" name="image" value="<?php echo htmlspecialchars($edit ? $banner['image'] : '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>

            <img src="<?php echo $banner['image'];?>" alt="banner" style="width: 25%">
        <?php endif;?>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-warning" >Save <i class="glyphicon glyphicon-send"></i></button>
    </div>
</fieldset>
