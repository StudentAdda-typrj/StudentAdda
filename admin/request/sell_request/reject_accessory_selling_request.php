<?php
    $page_title="Reject Accessory Selling Request";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $accessory = get_accessory_sell_request_detail_using_id($id);
    }
    if($accessory["verified"] !== null)
    {
        reject_accessory_selling_request($id);
    }
    echo "<script>window.location='/admin/request/sell_request/request_list';</script>";
	exit(0);
?>