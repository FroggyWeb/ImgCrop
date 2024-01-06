<?php
header('Content-Type: application/json');

define('MODX_API_MODE', true);
define('IN_MANAGER_MODE', true);

include_once(__DIR__."/../../../index.php");
$modx->db->connect();
if (empty ($modx->config)) {
        $modx->getSettings();
    }
if(!isset($_SESSION['mgrValidated'])){
        die();
    }

if (!empty($_FILES['file']) && !$_FILES['file']['error'] && is_uploaded_file($_FILES['file']['tmp_name'])) {
    $path = pathinfo($_POST['path']);
    $fileCrop = $_FILES['file']['tmp_name'];
    $pathRes = $path['dirname'].'/'.$path['filename'].'_crop'.'.'.$path['extension'];
    move_uploaded_file($fileCrop, MODX_BASE_PATH.'/'.$pathRes);

    MODX_BASE_PATH;
    echo json_encode( $pathRes );
}

