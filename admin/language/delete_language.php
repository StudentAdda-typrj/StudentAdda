<?php
    $page_title="Delete Language";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        delete_language_by_id($id);
    }
    echo "<script>window.location='/admin/language/create_language';</script>";
	exit(0);
?>