<?php
	$page_title = "User List";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");
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
									<strong>User List</strong>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-sm table-bordered master_config_table">
											<thead class="text-center master_config_table_head">
												<tr>
													<th>Sr. No.</th>
													<th class="col-md-5">Email Address</th>
													<th class="col-md-2">Enable/Disable</th>
													<th class="col-md-2">Account Verified</th>
													<th class="col-md-2">Details</th>
												</tr>
											</thead>
											<tbody class="text-secondary">
												<?php if($users = get_user_list_from_users()):?>
													<?php 
														$number = 1;
														foreach($users as $user):
													?>
														<tr>
															<td><?php echo $number?></td>
															<td><?php echo $user["email_address"]?></td>
															<td>
																<?php if($user["disabled"] === "0"):?>
																	<a href="/admin/users/enable_disable_user?user_id=<?php echo $user["user_id"]; ?>" class="btn btn-sm btn-success mx-auto d-block col-md-8" id="enable" name="enable"><span class="fa-solid fa-lock-open"></span> Enable</a>
																<?php else:?>
																	<a href="/admin/users/enable_disable_user?user_id=<?php echo $user["user_id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="disable" name="disable"><span class="fa-solid fa-lock"></span> Disabled</a>
																<?php endif;?>
															</td>
															<td>
																<?php if($user["account_verified"] === "0"): ?>
																	<a href="/admin/users/approve_disapprove_user?user_id=<?php echo $user["user_id"]; ?>" class="btn btn-warning btn-sm mx-auto d-block col-md-8" id="pending" name="pending"><i class="fa-regular fa-circle-dot"></i> Pending</a>
																<?php elseif($user["account_verified"] === "-1"): ?>
																	<a href="/admin/users/approve_disapprove_user?user_id=<?php echo $user["user_id"]; ?>" class="btn btn-danger btn-sm mx-auto d-block col-md-8" id="disapprove" name="disapprove"><span class="fa fa-xmark-circle"></span> Disapproved</a>
																<?php else: ?>
																	<a href="/admin/users/approve_disapprove_user?user_id=<?php echo $user["user_id"]; ?>" class="btn btn-success btn-sm mx-auto d-block col-md-8" id="approve" name="approve"><span class="fa fa-check-circle"></span> Approved</a>
																<?php endif; ?>
															</td>
															<td>
																<a href="/admin/users/user_details?user_id=<?php echo $user["user_id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8"><i class="fa-solid fa-circle-info"></i> Details</a>
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