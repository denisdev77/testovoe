<?php
require_once 'config/config.php';

// Serve POST method, after successful insert, redirect to banner page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data_to_db = array_filter($_POST);

    // Insert timestamp
    $data_to_db['created_time'] = date('Y-m-d H:i:s');
    $data_to_db['updated_time'] = date('Y-m-d H:i:s');

    if (empty($_FILES['image']['size'])) {
        die;
    }
    if ($_FILES['image']['size'] > (5 * 1024 * 1024)) {
        echo 'File size should not exceed 5Mb ';
    }

    $imageInfo = getimagesize($_FILES['image']['tmp_name']);
    $arr = array('image/jpg', 'image/png');

    if (!array_search($imageInfo['mime'], $arr)) {

        echo 'Picture must be format JPG or PNG';

    } else {

//        $dir = 'assets/img/banners/';
        $dir = $_POST['url'];
        $fileName = $dir . date('YmdHis') . basename($_FILES['image']['name']);
        $move = move_uploaded_file($_FILES['image']['tmp_name'], $fileName);

        if ($move) {
            $convertFileName = htmlentities(stripslashes(strip_tags(trim($fileName))), ENT_QUOTES, 'UTF-8');
            $data_to_db['image'] = $convertFileName;
            $db = getDbInstance();
            $status = $db->insert('banners', $data_to_db);

            if (!$status) {
                echo 'Insert failed: ' . $db->getLastError();
                exit();
            }
            header('Location: banners.php');
            exit();

        } else {
            echo 'Error.An error occurred while loading the photo. Please try again.';
        }
    }
}

// We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

include BASE_PATH . '/includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Add Banners</h2>
        </div>
    </div>
    <!-- Flash messages -->
    <!--    --><?php //include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post" id="banner_form" enctype="multipart/form-data">
        <?php include BASE_PATH . '/forms/banner_form.php'; ?>
    </form>
</div>
<?php include BASE_PATH . '/includes/footer.php'; ?>
