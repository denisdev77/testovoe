<?php
require_once 'config/config.php';

$banner_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;
$db = getDbInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Get banner id form query string parameter.
    $banner_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

    // Get input data
    $data_to_db = filter_input_array(INPUT_POST);

    if(empty($_FILES['image']['size'])){
       echo 'Empty image';
    }

    if($_FILES['image']['size'] > (5 * 1024 * 1024)){
        echo 'File size should not exceed 5Mb ';
    }

    $imageInfo=getimagesize($_FILES['image']['tmp_name']);
    $arr=array('image/jpg','image/png');

    if(!array_search($imageInfo['mime'],$arr)){
        echo 'Picture must be format JPG or PNG';
    }else{
        $dir='assets/img/banners/';
        $fileName=$dir.date('YmdHis').basename($_FILES['image']['name']);

        $move=move_uploaded_file($_FILES['image']['tmp_name'],$fileName);
        if($move){
            $convertFileName=htmlentities(stripslashes(strip_tags(trim($fileName))),ENT_QUOTES,'UTF-8');
            $data_to_db['image']=$convertFileName;
            $data_to_db['updated_time'] = date('Y-m-d H:i:s');
            $db = getDbInstance();
            $db->where('id', $banner_id);
            $status = $db->update('banners', $data_to_db);
            if ($status)
            {
                header('Location: banners.php');
                exit();
            }
        }else{
            echo 'Error.An error occurred while loading the photo. Please try again.';
        }
    }

}

// If edit variable is set, we are performing the update operation.
if ($edit)
{
    $db->where('id', $banner_id);

    $banner = $db->getOne('banners');
}
?>
<?php include BASE_PATH.'/includes/header.php'; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Update Banner</h2>
        </div>
    </div>

    <form class="form" action="" method="post" id="banner_form" enctype="multipart/form-data">
        <?php include BASE_PATH.'/forms/banner_form.php'; ?>
    </form>
</div>
<?php include BASE_PATH.'/includes/footer.php'; ?>
