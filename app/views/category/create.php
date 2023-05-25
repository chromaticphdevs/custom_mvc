<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Category</h4>
            <?php echo wLinkDefault(_route('category:index'), 'Categories')?>
            <?php Flash::show()?>
        </div>

        <div class="card-body">
            <?php echo $category_form->getForm()?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>