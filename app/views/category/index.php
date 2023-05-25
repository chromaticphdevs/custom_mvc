<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Categories</h4>
            <?php echo wLinkDefault(_route('category:create'), 'Create', ['icon' => 'plus-circle'])?> | 
            <?php echo wLinkDefault(_route('category:index', null, [
                'category' => 'CATALOG_PARENT'
            ]), 'Department')?>
            <?php echo wLinkDefault(_route('category:index', null, [
                'category' => 'CATALOG_CHILD'
            ]), 'Course')?>
            <?php Flash::show()?>

            <?php echo wLinkDefault(_route('category:index', null,), 'Show All')?>
            <?php Flash::show()?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>ABBR</th>
                        <th>Category For</th>
                        <th>Parent</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach ($categories as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->name?></td>
                                <td><?php echo $row->abbr?></td>
                                <td><?php echo $row->category?></td>
                                <td><?php echo $row->parent_name?></td>
                                <td>
                                    <?php
                                        echo $row->active ? 'Active' : 'Not Active';
                                    ?>
                                </td>
                                <td>
                                    <?php echo wLinkDefault(_route('category:show', $row->id),'Show')?> | 
                                    <?php echo wLinkDefault(_route('category:edit', $row->id),'Edit')?> | 
                                    <?php echo wLinkDefault(_route('category:deactivate', $row->id),'Activate Or Deactivate')?>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>