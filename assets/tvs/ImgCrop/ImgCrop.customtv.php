<?php

if (!IN_MANAGER_MODE) die();
global $content;
include_once(MODX_BASE_PATH.'assets/tvs/ImgCrop/core/ImgCropController.php');

$tv = new \ImgCrop\ImgCropController (
    $modx,
    $row,
);

echo $tv->render();
?>
