<?php

use App\Core\Auth;

require __DIR__ . '/../layouts/head.php'; ?>

<div class="row">
	<div class="col-md-12 pb-3">
		<a href="<?= route('/project/add') ?>" class="btn btn-success btn-sm text-rigth"><i class="fas fa-plus"></i> Add Project</a>
	</div>
</div>

<div class="row pb-3">
	<div class="col">
		<?= msg('RESPONSE_MSG'); ?>
		<div class="card">
			<!-- Light table -->
			<div class="table-responsive">
				<table class="table align-items-center table-striped" id="projectTable">
					<thead class="thead-light">
						<tr>
							<th scope="col" class="sort" data-sort="name">Project Code</th>
							<th scope="col" class="sort" data-sort="budget">Project Name</th>
							<th scope="col" class="sort" data-sort="status">Project Description</th>
							<th style="width: 100px;"></th>
						</tr>
					</thead>
					<tbody class="list">
						<?php foreach ($project_datas as $projects) : ?>
							<tr>
								<td><?= $projects->project_code ?></td>
								<td><?= $projects->project_name ?></td>
								<td><?= $projects->description ?></td>
								<td style="vertical-align: middle;text-align: center;">
									<a class="text-muted mr-2" href="<?= route("/project/view/{$projects->id}") ?>" style="font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="View">
										<i class="far fa-eye"></i>
									</a>
									<a class="text-muted mr-2" href="<?= route('/project/detail', $projects->id) ?>" style="font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="Edit">
										<i class="far fa-edit"></i>
									</a>
									<a class="text-muted mr-2" href="<?= route('/project/delete', $projects->id) ?>" style="font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="event.preventDefault(); document.getElementById('delete-project-form').submit();">
										<i class="far fa-trash-alt"></i>
									</a>

									<form id="delete-project-form" action="<?= route('/project/delete', $projects->id) ?>" method="POST" style="display:none;">
										<?= csrf() ?>
									</form>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#projectTable').DataTable();
	});
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>