<?php

    use common\models\User;
    
/** @var yii\web\View $this */
/** @var User[] $authorsList */

$this->title = 'Books list';
    
    $this->registerJsFile('/js/datatable.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-12">
                <form class="row" id="table_filter">
                    <div class="col-sm mb-3">
                        <input type="text" class="form-control form-control-sm" data-col-index="1" placeholder="Title" aria-label="Title">
                    </div>
                    <div class="col-sm mb-3">
                        <input type="text" class="form-control form-control-sm" data-col-index="2" placeholder="ISBN" aria-label="Code">
                    </div>
                    <div class="col-sm mb-3">
                        <select class="form-control form-control-sm" data-col-index="5" aria-label="Author">
                            <option value="">Select author</option>
                            <?php
                                /**
                                 * @var User $author
                                 */
                                foreach ($authorsList as $author):
                            ?>
                                <option value="<?= $author->id ?>"><?= $author->username ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-sm mb-3 d-flex">
                        <button type="submit" class="btn btn-primary mx-1 btn-sm" style="max-height: 30px">
                            Search
                        </button>
                        <button type="reset" class="btn btn-secondary btn-sm ml-2 btn-sm" style="max-height: 30px">
                            Clear filter
                        </button>
                    </div>
                </form>
                <table id="data-table" class="table table-striped table-bordered"></table>
            </div>
        </div>

    </div>
</div>
