<?php
    $page_title="Delete Department";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        delete_department_by_id($id);
    }
    echo "<script>window.location='/admin/department/create_department';</script>";
	exit(0);
?>