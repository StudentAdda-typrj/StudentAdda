<?php
    $page_title="Enable/Disable Accessory";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $accessory = get_uploaded_accessories_by_id($id);
    }

    if($accessory["disabled"] === "0")
    {
        $disabled = '1';
        enable_disable_accessory($disabled, $id);
    }
    else
    {
        $disabled = '0';
        enable_disable_accessory($disabled, $id);
    }
    echo "<script>window.location='/admin/accessory/create_accessory';</script>";
	exit(0);
?>