<?php
    $page_title="Delete Accessory";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        delete_accessory_by_id($id);
    }
    echo "<script>window.location='/admin/accessory/create_accessory';</script>";
	exit(0);
?>