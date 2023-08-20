<?php
    $page_title="Enable/Disable User";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["user_id"]) && !empty($_GET["user_id"]) && is_numeric($_GET["user_id"]))
    {
        $id = trim($_GET["user_id"]);
        $user = get_user_by_passing_id($id);
    }

    if($user["disabled"] === "0")
    {
        $disabled = '1';
        enable_disable_user($disabled, $id);
    }
    else
    {
        $disabled = '0';
        enable_disable_user($disabled, $id);
    }
    echo "<script>window.location='/admin/users/user_list';</script>";
	exit(0);
?>