<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Catalog</h4> 
            <?php echo wLinkDefault(_route('item:show', $catalog->id), 'Back to Catalog')?> | 
            <?php echo wLinkDefault(_route('item:index'), 'Catalogs')?>
            
        </div>

        <div class="card-body">
            <?php Flash::show()?>
            <?php echo $_form->start()?>
            <?php echo $_form->getCol('id')?>
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <?php
                            Form::label('Internal Reference');
                            Form::small('Auto generated Reference');
                            Form::text('internal_reference', $catalog->internal_reference ?? 'Not Available in Previous Version', [
                                'readonly' => true,
                                'class' => 'form-control'
                            ]);

                            if(is_null($catalog->internal_reference)) {
                                echo wLinkDefault(_route('item:generate-internal-reference', $catalog->id,[
                                    'returnTo' => seal(_route('item:edit', $catalog->id))
                                ]), 'Create Internal Reference', ['icon' => 'plus-circle']);
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <?php echo $_form->getCol('reference')?>
                    </div>
                    <div class="form-group">
                        <?php echo $_form->getCol('title')?>
                    </div>
                    <div class="form-group">
                        <?php echo $_form->getCol('brief')?>
                    </div>

                    <div class="form-group">
                        <?php echo $_form->getCol('description')?>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col"><?php echo $_form->getCol('tags')?></div>
                            <div class="col"><?php echo $_form->getCol('genre')?></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2"> <?php echo $_form->getCol('year', ['value' => date('Y')])?></div>
                            <div class="col"> <?php echo $_form->getCol('category_id_parent')?></div>
                                <div id="category_child_container" <?php echo !$category_id ? 'style="display:none"' : ''?>>
                                    <?php if($category_id) :?>
                                        <?php echo $form->getCol('category_id')?>
                                    <?php else:?>
                                        <select name="category_id" id="category_child" class="form-control"></select>
                                    <?php endif?>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <?php echo $_form->getCol('authors')?>
                        <small>Use user Id, Seperate by comma (',')</small>
                    </div>
                    <div class="form-group">
                        <?php echo $_form->getCol('publishers')?>
                        <small>Use user Id, Seperate by comma (',')</small>
                    </div>

                    <div class="form-group mt-3">
                        <?php Form::submit('', 'Save Changes')?>
                        <a href="<?php echo _route('item:delete', $catalog->id)?>" class="btn btn-danger btn-sm form-verify">Delete</a>
                        <a href="<?php echo _route('item:show', $catalog->id)?>" class="btn btn-sm" style="margin-left: 20px;">Show Catalog</a>
                    </div>
                </div>
            </div>

            <?php echo wDivider(40)?>
            <section class="mt-2">
                <h4>Image And Document</h4>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Wallpaper</td>
                            <td>
                                <?php if($catalog->wallpaper) :?>
                                    <a href="<?php echo _route('viewer:show', null, ['file' => $catalog->wallpaper->full_url])?>">
                                    <img src="<?php echo $catalog->wallpaper->full_url?>"></a>
                                <?php echo $catalog->wallpaper->display_name?>
                                <?php else:?>
                                    <label for="#">No Wallpaper Found</label>
                                <?php endif?>
                            </td>
                            <td>
                                <?php
                                    if($catalog->wallpaper) {
                                        echo wLinkDefault(_route('attachment:delete', $catalog->wallpaper->id, ['route' => seal(_route('item:edit', $catalog->id))]),'Remove', [
                                            'icon' => 'x-circle'
                                        ]);
                                        echo " | ";
                                    }
                                    echo wLinkDefault(_route('item:add-attachment', null, [
                                        'id' => seal($catalog->id),
                                        'type' => 'wallpaper'
                                    ]), 'Add', ['icon' => 'plus-circle']);
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Document</td>
                            <td>
                                <?php if($catalog->document) :?>
                                    <?php echo wLinkDefault(_route('viewer:show', null, ['file' => $catalog->document->full_url]), 'Show', [
                                        'icon' => 'eye'
                                    ]) ?>
                                    <?php echo $catalog->document->display_name?>
                                <?php endif?>
                            </td>
                            <td>
                                <?php
                                    if($catalog->document) {
                                        echo wLinkDefault(_route('attachment:delete', $catalog->document->id, ['route' => seal(_route('item:edit', $catalog->id))]),'Remove');
                                        echo " | ";
                                    }
                                    echo wLinkDefault(_route('item:add-attachment', null, [
                                        'id' => seal($catalog->id),
                                        'type' => 'pdf_file'
                                    ]), 'Add', ['icon' => 'plus-circle']);
                                ?>
                        </td>
                        </tr>
                    </table>
                </div>
            </section>
            <?php echo $_form->end()?>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts')?>
    <script>
        $(document).ready(function() {
            $("#category_id_parent").change(function() {

                $.ajax({
                    url: getURL('api/Category/getChild'),
                    data: {
                        'category_id' : $(this).val()
                    },
                    success : function(response) {
                        if(response) {
                            let items = JSON.parse(response);
                            if(items.length > 0) {
                                $("#category_child_container").show();
                                $("#category_child").append(new Option("--Select Option", ""));
                                for(let i in items) {
                                    $("#category_child").append(new Option(items[i].name, items[i].id));
                                }
                                return true;
                            } else {
                                console.log('empty');
                            }
                        }
                        $("#category_child_container").hide();
                        $('#category_child')
                        .find('option')
                        .remove()
                        .end();
                    }
                });

            });
        });
    </script>
<?php endbuild()?>

<?php loadTo()?>


