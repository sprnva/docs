<?php

use App\Core\Auth;
use App\Core\Request;

require 'layouts/head.php'; ?>

<div class="row justify-content-center mt-3" style="width: 100%;">
    <div class="col-sm-9 p-3 mb-4">
        <?= $data ?>
    </div>
</div>

<?php require 'layouts/footer.php'; ?>