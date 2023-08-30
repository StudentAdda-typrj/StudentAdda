<?php
    $page_title="Delete Subcategory";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        delete_subcategory_by_id($id);
    }
    echo "<script>window.location='/admin/sub_category/create_sub_category';</script>";
	exit(0);
?>