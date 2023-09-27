<?php
    $page_title = "Delete Cart items";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        delete_cart_item_by_id($id);
    }
    echo "<script>window.location='/user/shopping_cart/cart';</script>";
	exit(0);
?>