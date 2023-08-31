<?php
    $page_title="Accept Book Selling Request";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_book_sell_request_detail_using_id($id);
    }
    if($book["verified"] !== null)
    {
        accept_book_selling_request($id);
    }
    echo "<script>window.location='/admin/request/sell_request/request_list';</script>";
	exit(0);
?>