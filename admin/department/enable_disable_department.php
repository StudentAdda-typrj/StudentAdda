<?php
    $page_title="Enable/Disable Department";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $department = get_department_by_id($id);
    }

    if($department["disabled"] === "0")
    {
        $disabled = '1';
        enable_disable_department($disabled, $id);
    }
    else
    {
        $disabled = '0';
        enable_disable_department($disabled, $id);
    }
    echo "<script>window.location='/admin/department/create_department';</script>";
	exit(0);
?>