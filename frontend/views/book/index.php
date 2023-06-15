<?php
    
    use common\models\User;
    use yii\helpers\Url;
    use yii\web\View;
    
    /** @var yii\web\View $this */
    /** @var User[] $authorsList */
    
    $this->title = 'Books list';
    $currentUser = user();
    
    $js = <<<JS
window.USER = {
    'id': $currentUser->id,
    'username': "{$currentUser->username}"
};
JS;
    
    $this->registerJs($js, View::POS_READY);
    $this->registerJsVar('URL_edit_book', Url::to('/book/edit'), View::POS_HEAD);
    $this->registerJsVar('URL_book_read_path', Url::to(['book/read']), View::POS_HEAD);
    $this->registerJsVar('URL_image_path', '/images/', View::POS_HEAD);
    
    $this->registerJsFile('/js/datatable.js', ['depends' => [\yii\web\JqueryAsset::class]]);
    
    $this->registerCssFile('/css/book.css');
?>
<div class="site-index">
    <div class="body-content">
        <div class="row mb-4">
            <div class="col">
                <a href="<?=\yii\helpers\Url::to('/book/create') ?>" class="btn btn-success">Create book</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="row" id="table_filter">
                    <div class="col-sm mb-3">
                        <input type="text" class="form-control form-control-sm" data-col-index="2" placeholder="Title" aria-label="Title">
                    </div>
                    <div class="col-sm mb-3">
                        <input type="text" class="form-control form-control-sm" data-col-index="3" placeholder="ISBN" aria-label="Code">
                    </div>
                    <div class="col-sm mb-3">
                        <select class="form-control form-control-sm" data-col-index="6" aria-label="Author">
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
                    <div class="col-sm mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="only_my">
                            <label class="form-check-label" for="only_my">
                                Only my books
                            </label>
                        </div>
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
