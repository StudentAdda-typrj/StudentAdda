<?php
    $page_title="Enable/Disable Subcategory";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $subcategory = get_subcategory_by_id($id);
    }

    if($subcategory["disabled"] === "0")
    {
        $disabled = '1';
        enable_disable_subcategory($disabled, $id);
    }
    else
    {
        $disabled = '0';
        enable_disable_subcategory($disabled, $id);
    }
    echo "<script>window.location='/admin/sub_category/create_sub_category';</script>";
	exit(0);
?>