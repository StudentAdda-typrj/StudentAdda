<?php
    $page_title="Enable/Disable Book";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_uploaded_books_by_id($id);
    }

    if($book["disabled"] === "0")
    {
        $disabled = '1';
        enable_disable_book($disabled, $id);
    }
    else
    {
        $disabled = '0';
        enable_disable_book($disabled, $id);
    }
    echo "<script>window.location='/admin/book/create_book';</script>";
	exit(0);
?>