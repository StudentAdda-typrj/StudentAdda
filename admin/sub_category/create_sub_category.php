<?php
	$page_title = "Create Subcategory";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

	if(isset($_POST["add_subcategory"]))
    {
        add_subcategory_name($_POST);
        redirect_to_current_page();
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
					<div class="row">
						<div class="col-lg-12">
							<div class="card master_config_inner_card">
								<div class="card-header card_heading_text">
									<strong>Add Subcategory</strong>
								</div>
								<div class="card-body">
									<form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-lg-5">
												<div class="input-group-md">
													<label class="text-dark required-highlight" for="subcategory_name">Subcategory Name</label>
													<input class="form-control" type="text" placeholder="Subcategory Name" name="subcategory_name" id="subcategory_name" required>
												</div>
											</div>
											<div class="col-lg-2 mt-4">
												<button type="submit" id="add_subcategory" name="add_subcategory" class="btn master_config_button_style px-3">Add</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="card master_config_inner_card mt-3">
								<div class="card-header card_heading_text">
									<strong>View Category</strong>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-sm table-bordered master_config_table">
											<thead class="text-center master_config_table_head">
												<tr>
													<th>Sr. No.</th>
													<th class="col-md-5">Subcategory Name</th>
													<th class="col-md-2">Enable/Disable</th>
													<th class="col-md-2">Edit</th>
													<th class="col-md-2">Delete</th>
												</tr>
											</thead>
											<tbody class="text-secondary">
												<?php if($subcategories = get_subcategory_names()):?>
													<?php 
														$number = 1;
														foreach($subcategories as $subcategory):
													?>
														<tr>
															<td><?php echo $number?></td>
															<td><?php echo $subcategory["name"]?></td>
															<td>
																<?php if($subcategory["disabled"] === "0"):?>
																	<a href="/admin/sub_category/enable_disable_sub_category?q=<?php echo $subcategory["id"]; ?>" class="btn btn-sm btn-success mx-auto d-block col-md-8" id="enable" name="enable"><span class="fa-solid fa-lock-open"></span>  Enable</a>
																<?php else:?>
																	<a href="/admin/sub_category/enable_disable_sub_category?q=<?php echo $subcategory["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="disable" name="disable"><span class="fa-solid fa-lock"></span> Disabled</a>
																<?php endif;?>
															</td>
															<td>
																<a href="/admin/sub_category/edit_sub_category?q=<?php echo $subcategory["id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8"><span class="fa fa-edit"></span> Edit</a>
															</td>
															<td>
																<a href="/admin/sub_category/delete_sub_category?q=<?php echo $subcategory["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="delete_subcategory" name="delete_subcategory"><span class="fa fa-trash"></span> Delete</a>
															</td>
														</tr>
													<?php 
														$number += 1;
														endforeach
													?>
												<?php endif;?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
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