<?php
require_once 'config/config.php';
require_once BASE_PATH . '/model/Banners/Banners.php';


$banners = new Banners();

// Per page limit for pagination
$pagelimit = 20;

// Get current page
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
    $page = 1;
}


// Get DB instance  of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'name', 'type', 'url', 'target', 'status', 'image', 'created_time', 'updated_time');

// Set pagination limit
$db->pageLimit = $pagelimit;

// Get result of the query
$rows = $db->arraybuilder()->paginate('banners', $page, $select);
$total_pages = $db->totalPages;
?>
<?php include BASE_PATH . '/includes/header.php'; ?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Banners</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="create_banners.php?operation=create" class="btn btn-success"><i
                            class="glyphicon glyphicon-plus"></i> Add banner</a>
            </div>
        </div>
    </div>
    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Url</th>
            <th>Target</th>
            <th>Status</th>
            <th>Image</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['type']); ?></td>
                <td><?php echo htmlspecialchars($row['url']); ?></td>
                <td><?php echo htmlspecialchars($row['target']); ?></td>
<!--                <td>--><?php //echo htmlspecialchars($row['status']); ?><!--</td>-->
                <td><?php echo htmlspecialchars($row['status']=='2'?'Active':'Disabled'); ?></td>
                <td width="15%"><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="banner" style="width: 100%"></td>
                <td><?php echo htmlspecialchars($row['created_time']); ?></td>
                <td><?php echo htmlspecialchars($row['updated_time']); ?></td>
                <td>
                    <a href="edit_banners.php?id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" class="btn btn-danger delete_btn" data-toggle="modal"
                       data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_banners.php" method="POST">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Confirm</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                <p>Are you sure you want to delete this row?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default pull-left">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="text-center">
        <?php echo paginationLinks($page, $total_pages, 'banners.php'); ?>
    </div>
</div>
<?php include BASE_PATH . '/includes/footer.php'; ?>
