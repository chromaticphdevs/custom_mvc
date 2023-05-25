<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Catalogs</h4>
            <?php
                if(isAdmin()) {
                    echo wLinkDefault(_route('item:approval'), 'for approvals');
                }
            ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table dataTable">
                    <thead>
                        <th>#</th>
                        <th>Internal Reference</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Uploader</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($catalogs as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->internal_reference ?? 'N/A'?></td>
                                <td><?php echo $row->title?></td>
                                <td><?php echo $row->year?></td>
                                <td><?php echo $row->uploader_name?></td>
                                <td>
                                    <a href="<?php echo _route('item:show', $row->id)?>">Show</a>
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