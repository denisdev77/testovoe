<?php
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

    $banner_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $banner_id);
    $status = $db->delete('banners');
    
    if ($status) 
    {
        header('Location: banners.php');
        exit;
    }
    else
    {
    	header('Location: banners.php');
        exit;
    }
    
}