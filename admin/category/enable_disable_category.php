<?php
    $page_title="Enable/Disable Category";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $category = get_category_by_id($id);
    }

    if($category["disabled"] === "0")
    {
        $disabled = '1';
        enable_disable_category($disabled, $id);
    }
    else
    {
        $disabled = '0';
        enable_disable_category($disabled, $id);
    }
    echo "<script>window.location='/admin/category/create_category';</script>";
	exit(0);
?>