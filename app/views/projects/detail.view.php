<?php

use App\Core\Auth;

require __DIR__ . '/../layouts/head.php'; ?>

<div class="row">
	<div class="col-md-12">
		<a href="<?= route('/project') ?>" class="btn btn-default btn-sm text-rigth"><i class="fas fa-arrow-left"></i> Back</a>
	</div>
</div>

<div class="row">
	<div class="col-8 mt-2">
		<div class="card" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
			<div class="card-body">
				<?= msg('RESPONSE_MSG'); ?>

				<form method="POST" action="<?= route('/project/detail', $project_details['id']) ?>">
					<div class="form-group">
						<label for="username">Project Code</label>
						<input type="text" class="form-control" name="edit-proj-code" autocomplete="off" value="<?= $project_details['project_code'] ?>">
					</div>
					<div class="form-group">
						<label for="username">Project Name</label>
						<input type="text" class="form-control" name="edit-proj-name" autocomplete="off" value="<?= $project_details['project_name'] ?>">
					</div>
					<div class="form-group">
						<label for="username">Description</label>
						<input type="text" class="form-control" name="edit-proj-description" autocomplete="off" value="<?= $project_details['description'] ?>">
					</div>

					<div class="d-flex justify-content-end"><button type="submit" class="btn btn-default btn-sm text-rigth">UPDATE PROJECT</button></div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>