<?php build('content') ?>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Category</h4>
            <?php echo wLinkDefault(_route('category:index'), 'Back to Categories')?>
        </div>
        <div class="card-body">
            <?php Flash::show()?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Category : </td>
                        <td><?php echo $category->name?></td>
                    </tr>
                </table>
            </div>

            <?php echo wDivider(30)?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Category</th>
                        <th>Remove</th>
                    </thead>
                    <tbody>
                        <?php foreach($children as $key => $row) :?>
                            <tr>
                                <td><?php echo $row->name?></td>
                                <td><?php echo wLinkDefault(_route('category:remove', $row->id), 'Remove Child', [
                                    'icon' => 'x'
                                ])?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo()?>