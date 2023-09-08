<?php
    $page_title="Uploaded/Not_uploaded Accessory";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $accessory = get_accessory_sell_request_detail_using_id($id);
    }

    if($accessory["uploaded"] === "0")
    {
        $uploaded = '1';
        uploaded_not_uploaded_accessory($uploaded, $id);
    }
    else
    {
        $uploaded = '0';
        uploaded_not_uploaded_accessory($uploaded, $id);
    }
    echo "<script>window.location='/admin/accessory/create_accessory';</script>";
	exit(0);
?>