<?php
    $page_title="Delete Category";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        delete_category_by_id($id);
    }
    echo "<script>window.location='/admin/category/create_category';</script>";
	exit(0);
?>