<?php
    
    use yii\web\View;
    use yii\web\JqueryAsset;
    
    /** @var yii\web\View $this */
    /** @var array $authors */
    
    $this->registerCssFile('//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
    
    $this->registerJsFile('/js/report.js', ['depends' => [JqueryAsset::class]]);
    $this->registerJsFile('//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', ['depends' => [JqueryAsset::class]]);


?>


<div class="body-content">
    <div class="row">
        <div class="col-12">
            <table id="report-datatable" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Books count</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($authors as $author) : ?>
                        <tr>
                            <td><?= $author['username'] ?></td>
                            <td><?= $author['year'] ?></td>
                            <td><?= $author['book_count'] ?></td>
                        </tr>
                    
                    <?php
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
