<?php  if(!empty($_SESSION["success_messages"])): ?>
	<div class="col-md-12">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<h4>Success</h4>
			<ul>
				<?php foreach($_SESSION["success_messages"] as $message): ?>
					<li><?php echo $message; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php unset($_SESSION["success_messages"]); ?>
	
<?php elseif(!empty($_SESSION["error_messages"])): ?>
	<div class="col-md-12">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<h4>Errors</h4>
			<ul>
				<?php foreach($_SESSION["error_messages"] as $message): ?>
					<li><?php echo $message; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php unset($_SESSION["error_messages"]); ?>
	
<?php elseif(!empty($_SESSION["info_messages"])): ?>
	<div class="col-md-12">
		<div class="alert alert-info alert-dismissible fade show" role="alert">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<h4>Info</h4>
			<ul>
				<?php foreach($_SESSION["info_messages"] as $message): ?>
					<li><?php echo $message; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php unset($_SESSION["info_messages"]); ?>
<?php elseif(!empty($_SESSION["warning_messages"])): ?>
	<div class="col-md-12">
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<h4>Warning</h4>
			<ul>
				<?php foreach($_SESSION["warning_messages"] as $message): ?>
					<li><?php echo $message; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php unset($_SESSION["warning_messages"]); ?>
<?php endif; ?>