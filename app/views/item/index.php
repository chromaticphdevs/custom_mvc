<?php build('content') ?>
<?php Flash::show()?>
    <?php if(!isset($catalogs)) :?>
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-body text-center">
                    <?php
                        Form::open([
                            'method' => 'get'
                        ]);
                    ?> 
                        <h4>Your Search Starts Here..</h4>
                        <?php if(isset($_GET['searchFocus'])) :?>
                            <div class="text-danger mt-2 mb-2">Narrowing search, search focus to: <strong><?php echo $_GET['searchFocus']?></strong></div>
                        <?php endif?>
                        <div class="form-group"><?php Form::text('keyword', '', ['class' => 'form-control','autocomplete'=>'off' , 'required' => true, 
                        'placeholder' => 'search by tags : #tagname'])?></div>
                        <div class="form-group text-center mt-4">
                            <?php Form::submit('btn_search','Search By Keyword', ['class' => 'btn btn-primary btn-lg',])?>
                        </div>
                    <?php Form::close()?>
                </div>

                <div class="card-footer">
                    <div class="text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#advanceSearchModal">Advance Search</a>
                    </div>

                    <div class="modal fade" id="advanceSearchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="advanceSearchModal">Advance Search Form</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                        Form::open([
                                            'method' => 'get'
                                        ]);
                                    ?>
                                        <div class="form-group">
                                            <?php
                                                Form::label('Keyword');
                                                Form::text('keyword',  '', [
                                                    'class' => 'form-control'
                                                ]);
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                Form::label('Category');
                                                Form::select('category_id_parent', $categories, '', [
                                                    'class' => 'form-control',
                                                    'id'    => 'category_id_parent'
                                                ]);
                                            ?>
                                        </div>

                                        <section id="category_children_container">
                                        </section>
                                        
                                        <div class="form-group">
                                            <?php
                                                Form::label('Publisher(s)');
                                                Form::text('publishers', '', [
                                                    'class' => 'form-control'
                                                ]);
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                                Form::label('Author(s)');
                                                Form::text('authors', '', [
                                                    'class' => 'form-control'
                                                ]);
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php
                                                        Form::label('Start Year');
                                                        Form::number('start_year', '', [
                                                            'class' => 'form-control'
                                                        ]);
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                        Form::label('End Year');
                                                        Form::number('end_year', '', [
                                                            'class' => 'form-control'
                                                        ]);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php Form::submit('advance_search', 'Apply Filter');?>
                                        </div>
                                    <?php Form::close()?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(isset($_GET['searchFocus'])) :?>
                        <div>
                            <h5>Search Focus Children</h5>
                            <?php
                                if(isset($children)) {
                                    foreach($children as $key => $row)  {
                                        $unique_id = random_letter(5).'-'.$row->id;
                                        ?> 
                                            <label for="<?php echo $unique_id?>">
                                                <input type="checkbox" value="<?php echo $row->id?>" name="category_children[]"
                                                    id="<?php echo $unique_id?>">
                                                <?php echo $row->name?>
                                            </label>
                                        <?php
                                    }
                                }
                                
                            ?>
                        </div>
                        <div class="text-danger mt-2 mb-2">Narrowing search, search focus to: <strong><?php echo $_GET['searchFocus']?></strong></div>
                    <?php endif?>
                </div>
            </div>
        </div>
    <?php else:?>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Catalogs</h4>
                <?php
                        Form::open([
                            'method' => 'get'
                        ]);
                    ?>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group"><?php Form::text('keyword', $_GET['keyword'] ?? '', ['class' => 'form-control','autocomplete'=>'off' , 'required' => true, 'placeholder' => 'search by tags : #tagname'])?></div>
                        </div>
                        <div class="col-md-3">
                            <?php Form::submit('btn_search','Search By Keyword', ['class' => 'btn btn-primary btn-sm',])?>
                        </div>
                    </div>
                <?php Form::close()?>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <label for="#">Search Result for <h5 style="display: inline;"> '<?php echo $_GET['keyword']?>'</h5> </label>
                        <div><small>Total Results : <?php echo count($catalogs)?></small></div>
                        <?php echo wDivider()?>

                        <div class="row">
                            <div class="col-md-7">
                                <?php if(empty($catalogs)) :?>
                                    <p class="text-danger">
                                        No Result found for '<?php echo $_GET['keyword']?>'
                                        <?php if(isset($_GET['advance_search'])) :?>
                                            <a href="<?php echo _route('item:index')?>">Search Again</a>
                                        <?php endif?>
                                    </p>
                                    <?php echo wDivider('20')?>

                                    <?php if(!empty($possibleCatalogs)) :?>
                                        
                                    <small>Other topics tha you might be intrested in.</small>
                                    <?php foreach($possibleCatalogs as $catalog) :?>
                                        <?php echo wCatalogToStringToLink($catalog->tags, _route('item:index'), 'tags')?>
                                    <?php endforeach?>
                                    <?php echo wDivider('20')?>

                                    <h5>You might be looking for..</h5>
                                        <?php foreach($possibleCatalogs as $catalog) :?>
                                            <div class="mt-3">
                                                <h5>
                                                    <a href="<?php echo _route('item:show', $catalog->id)?>" style="text-decoration:underline"><?php echo $catalog->title?></a>
                                                </h5>
                                                <p><?php echo crop_string($catalog->brief, 100)?></p>
                                                <div><small>(<?php echo $catalog->genre?>) <?php echo $catalog->year?></small></div>
                                                <div><a href="#"><?php echo $catalog->authors?></a></div>
                                                <div style="font-size: 8pt;"><?php echo !empty($catalog->view_total) ? 'Views : '.$catalog->view_total : ''?> <?php echo !empty($catalog->like_total) ? 'Likes : '.$catalog->like_total : ''?> </div>
                                            </div>
                                        <?php endforeach?>
                                    <?php endif?>
                                <?php else:?>
                                    <?php foreach($catalogs as $catalog) :?>
                                        <div class="mt-3">
                                            <h5>
                                                <a href="<?php echo _route('item:show', $catalog->id)?>" style="text-decoration:underline"><?php echo $catalog->title?></a>
                                            </h5>
                                            <p><?php echo crop_string($catalog->brief, 100)?></p>
                                            <div><small>(<?php echo $catalog->genre?>) <?php echo $catalog->year?></small></div>
                                            <div><a href="#"><?php echo $catalog->authors?></a></div>
                                            <div style="font-size: 8pt;"><?php echo !empty($catalog->view_total) ? 'Views : '.$catalog->view_total : ''?> <?php echo !empty($catalog->like_total) ? 'Likes : '.$catalog->like_total : ''?> </div>
                                        </div>
                                    <?php endforeach?>
                                <?php endif?>
                            </div>

                            <?php if(isset($otherResults) && !empty($otherResults)) :?>
                                <div class="col-md-5">
                                    <label for="#" class="mb-5">Other Results Related to <h5 style="display: inline;"> '<?php echo $_GET['keyword']?>'</h5></label>
                                    
                                    <?php foreach($otherResults as $key => $catalog) :?>
                                        <div style="font-size: 76%;">
                                            <h5>
                                                <a href="<?php echo _route('item:show', $catalog->id)?>" style="text-decoration:underline"><?php echo $catalog->title?></a>
                                            </h5>
                                            <p><?php echo crop_string($catalog->brief, 100)?></p>
                                            <div><small>(<?php echo $catalog->genre?>) <?php echo $catalog->year?></small></div>
                                            <div><a href="#"><?php echo $catalog->authors?></a></div>
                                            <div style="font-size: 8pt;"><?php echo !empty($catalog->view_total) ? 'Views : '.$catalog->view_total : ''?> <?php echo !empty($catalog->like_total) ? 'Likes : '.$catalog->like_total : ''?> </div>
                                        </div>
                                    <?php endforeach?>
                                </div>
                            <?php endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif?>
<?php endbuild()?>


<?php build('scripts') ?>
    <script>
        $(document).ready(function() 
        {
            let category_children_container = $("#category_children_container");
            $("#category_id_parent").change(function() {
                let categoryId = $(this).val();
                category_children_container.html('');
                $.ajax({
                    method : 'post',
                    data : {
                        category_id : categoryId
                    },
                    url : getURL('api/Category/getChild'),
                    success : function(response) {
                        let responseData = JSON.parse(response);
                        let html ='';

                        for(let i in responseData) {
                            let responseID = responseData[i].id;
                            let responseName = responseData[i].name;

                            html += `
                                <label for="cat_id${responseID}">
                                    <input type="checkbox" id="cat_id${responseID}" name="category_child[]" value='${responseID}'>
                                    ${responseName}
                                </label>
                            `;
                        }

                        category_children_container.html(html);
                    }
                });
            });
        });
    </script>
<?php endbuild()?>
<?php loadTo()?>
