<?php build('content') ?>
    <div class="card col-md-5 mx-auto">
        <div class="card-header">
            <h4 class="card-title">Add Attachment To Catalog</h4>
            <?php echo wLinkDefault(_route('item:show', $id), 'Back To Catalog')?>
        </div>

        <div class="card-body">
            <?php
                Form::open([
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ])
            ?>
                <div class="form-group">
                    <?php
                        $label = isEqual($type,'pdf_file') ? 'SELECT PDF FILE ONLY': 'SELECT IMAGE FILE TYPE ONLY(jpg,jpeg,png,bitmap)';
                        Form::label($label);
                        if($type == 'pdf_file') {
                            Form::file('pdf_file', ['required' => true, 'class' => 'form-control']);
                        } else {
                            Form::file('wallpaper', ['required' => true, 'class' => 'form-control']);
                        }
                    ?>
                </div>

                <div class="form-group mt-4">
                    <?php Form::submit('', 'Add Attachment')?>
                </div>
            <?php Form::close()?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>


