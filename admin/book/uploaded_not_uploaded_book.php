<?php
    $page_title="Uploaded/Not_uploaded Book";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_book_sell_request_detail_using_id($id);
    }

    if($book["uploaded"] === "0")
    {
        $uploaded = '1';
        uploaded_not_uploaded_book($uploaded, $id);
    }
    else
    {
        $uploaded = '0';
        uploaded_not_uploaded_book($uploaded, $id);
    }
    echo "<script>window.location='/admin/book/create_book';</script>";
	exit(0);
?>