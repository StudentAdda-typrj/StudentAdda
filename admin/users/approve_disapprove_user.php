<?php
    $page_title = "Pending to Approve to Disapprove User";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/nav.php");

    if (isset($_GET["user_id"]) && !empty($_GET["user_id"]) && is_numeric($_GET["user_id"])) {
        $id = trim($_GET["user_id"]);
        $user = get_user_by_passing_id($id);
    }

        if ($user["account_verified"] === "0") 
        {
            $account_verified = "1";
            pending_approve_disapprove_user($account_verified, $id);
        } 
        elseif ($user["account_verified"] === "1")
            {
                $account_verified = "-1";
                pending_approve_disapprove_user($account_verified, $id);
            }
        else
            {
                $account_verified = "1";
                pending_approve_disapprove_user($account_verified, $id);
            }
    echo "<script>window.location='/admin/users/user_list';</script>";
    exit(0);
?>