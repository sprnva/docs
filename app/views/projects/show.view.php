<?php

use App\Core\Auth;

require __DIR__ . '/../layouts/head.php'; ?>

<div class="row">
    <div class="col-md-12">
        <a href="<?= route('/project') ?>" class="btn btn-default btn-sm text-rigth"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row mt-3">
    <div class="col">
        <div class="card card-stats" style="background-color: #fff; border: 1px #aaa; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th class="text-right p-2">PROJECT CODE :</th>
                            <td><?= $project['project_code'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-right p-2">PROJECT NAME :</th>
                            <td><?= $project['project_name'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-right p-2">DESCRIPTION :</th>
                            <td><?= $project['description'] ?></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>