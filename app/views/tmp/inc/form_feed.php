<?php
    use Form\FeedForm;
    load(['FeedForm'], FORMS);
    
    $feedForm = new FeedForm();
?>
<div id="feedForm">
    <?php echo $feedForm->start(['url' => _route('feed:create'), 'method' => 'post'])?>
        <div class="hidden">
            <?php
                Form::hidden('_returnRoute', $returnRoute);
                if(isset($parentId)) {
                    Form::hidden('parent_id', $parentId);
                }
                if(isset($parentKey)) {
                    Form::hidden('parent_key', $parentKey);
                }
            ?>
        </div>
        <div class="form-group">
            <?php echo $feedForm->getCol('title')?>
        </div>
        <div class="form-group">
            <?php echo $feedForm->getCol('content')?>
        </div>
        <div class="form-group">
            <?php echo $feedForm->getCol('tags')?>
        </div>
        <div class="form-group">
            <?php echo $feedForm->getCol('category', ['value' => 'feed'])?>
        </div>
        <div class="form-group">
            <?php Form::submit('', 'Create Feed')?>
        </div>
    <?php echo $feedForm->end()?>
</div>

<?php unset($feedForm)?>