<?php
    $page_title="Delete Book";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        delete_book_by_id($id);
    }
    echo "<script>window.location='/admin/book/create_book';</script>";
	exit(0);
?>