<?php

/** @var yii\web\View $this */

$this->title = 'Books list';
    
    $this->registerJsFile('/js/datatable.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-12">
                <table id="data-table" class="table table-striped table-bordered"></table>
            </div>
        </div>

    </div>
</div>
