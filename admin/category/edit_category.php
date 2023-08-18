<?php
	$page_title = "Edit Category";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

	$category = false;
    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $category = get_category_by_id($id);
    }

    if(isset($_POST["change"]))
    {
        $category_name = trim($_POST["category_name"]);
        edit_category_by_id($category_name, $id);
        redirect_to_current_page("q=$id");
    }
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card master_config_main_card my-5">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
						</div>
					</div>
					<div class="card master_config_inner_card">
						<div class="card-header">
							<strong>Edit Category</strong>
						</div>
						<div class="card-body">
                            <form role="form" action="<?php echo get_action_attr_value_for_current_page()."?q=".$category["id"]; ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
									<div class="col-lg-5">
										<div class="input-group-md">
											<label class="text-dark required-highlight">Category Name</label>
											<input class="form-control mb-3" type="text" placeholder="Category Name" name="category_name" id="category_name" value="<?php echo $category["name"]; ?>" required>
										</div>
									</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-sm master_config_button_style" id="change" name="change">Change</button>
                                        <a href="/admin/category/create_category" class="btn btn-sm btn-danger master_config_cancel_button">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>