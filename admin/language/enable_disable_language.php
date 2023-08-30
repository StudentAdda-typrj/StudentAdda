<?php
    $page_title="Enable/Disable Language";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $language = get_language_by_id($id);
    }

    if($language["disabled"] === "0")
    {
        $disabled = '1';
        enable_disable_language($disabled, $id);
    }
    else
    {
        $disabled = '0';
        enable_disable_language($disabled, $id);
    }
    echo "<script>window.location='/admin/language/create_language';</script>";
	exit(0);
?>