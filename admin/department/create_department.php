<?php
	$page_title = "Create Department";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

	if(isset($_POST["add_department"]))
    {
        add_department_name($_POST);
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
									<strong>Add Department</strong>
								</div>
								<div class="card-body">
									<form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-lg-5">
												<div class="input-group-md">
													<label class="text-dark required-highlight" for="department_name">Department Name</label>
													<input class="form-control" type="text" placeholder="Department Name" name="department_name" id="department_name" required>
												</div>
											</div>
											<div class="col-lg-2 mt-4">
												<button type="submit" id="add_department" name="add_department" class="btn master_config_button_style px-3">Add</button>
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
													<th class="col-md-5">Department Name</th>
													<th class="col-md-2">Enable/Disable</th>
													<th class="col-md-2">Edit</th>
													<th class="col-md-2">Delete</th>
												</tr>
											</thead>
											<tbody class="text-secondary">
												<?php if($departments = get_department_names()):?>
													<?php 
														$number = 1;
														foreach($departments as $department):
													?>
														<tr>
															<td><?php echo $number?></td>
															<td><?php echo $department["name"]?></td>
															<td>
																<?php if($department["disabled"] === "0"):?>
																	<a href="/admin/category/enable_disable_category?q=<?php echo $department["id"]; ?>" class="btn btn-sm btn-success mx-auto d-block col-md-8" id="enable" name="enable"><span class="fa-solid fa-lock-open"></span>  Enable</a>
																<?php else:?>
																	<a href="/admin/category/enable_disable_category?q=<?php echo $department["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="disable" name="disable"><span class="fa-solid fa-lock"></span> Disabled</a>
																<?php endif;?>
															</td>
															<td>
																<a href="/admin/category/edit_category?q=<?php echo $department["id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8"><span class="fa fa-edit"></span> Edit</a>
															</td>
															<td>
																<a href="/admin/category/delete_category?q=<?php echo $department["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="delete_category" name="delete_category"><span class="fa fa-trash"></span> Delete</a>
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