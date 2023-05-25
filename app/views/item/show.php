<?php build('content') ?>
<?php Flash::show()?>
    <?php if(!$catalog->is_viewable) :?>
        <div class="alert alert-warning">
            <p class="alert-text">Only you can see this catalog. waiting for admin approval to post your catalog in public.</p>
            <?php if(isAdmin()) :?>
                <?php echo wLinkDefault(_route('item:approval', null, [
                    'itemID' => seal($catalog->id),
                    'action' => 'approve'
                ]), 'Approve', [
                    'icon' => 'check-circle',
                    'class' => 'btn btn-primary'
                ])?>
            <?php endif?>
        </div>
    <?php endif?>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h4 class="card-title" style="display:inline-block"><?php echo $catalog->title?></h4>
                        <?php if($catalog->category_name) :?>
                            <span class="badge bg-primary">
                                <?php echo $catalog->category_name?>
                            </span>
                        <?php endif?>
                        <?php if($catalog->internal_reference) :?>
                            <small style="display:block">Internal Reference #<?php echo $catalog->internal_reference?></small>
                            <br>
                        <?php endif?>
                    </div>
                    <?php
                        if(isAdmin() || isEqual(whoIs('id'), $catalog->uploader_id)) {
                            echo wLinkDefault(_route('item:edit', $catalog->id),'Edit Catalog', [
                                'icon' => 'edit'
                            ]);
                        } 
                    ?>
                    &nbsp;
                    &nbsp;
                    <?php echo wLinkDefault(_route('item:index', $catalog->id),'Return To catalogs')?>
                </div>
                <div class="card-body" style=" overflow-wrap: break-word;">
                    <div class="align-items-start" id="catalog_detail">
                        <?php if($catalog->wallpaper) :?>
                            <div>
                                <img src="<?php echo $catalog->wallpaper->full_url?>" 
                                class="wd-900 wd-sm-150 me-3" alt="..." style="width: 200px">
                            </div>
                        <?php else:?>
                           <div> <img src="https://www.thesecret.tv/wp-content/uploads/2015/05/Daily-Teaching-Book.png" class="wd-100 wd-sm-200 me-3" alt="..." style="width: 200px;"></div>
                        <?php endif?>
                        <div id="item-summary">
                            <h5 class="mb-2">Course And Section</h5>
                            <p><?php echo $catalog->brief?></p>
                            <div class="mt-3">
                                <ul class="list-unstyled">
                                    <li>Year : <?php echo $catalog->year?></li>
                                    <li>Genre : 
                                        <?php if(!empty($catalog->genre)): ?>
                                            <?php echo wCatalogToStringToLink($catalog->genre, _route('item:index'), 'genre')?>
                                        <?php else:?>
                                            None
                                        <?php endif?>
                                    </li>
                                    <li>Tags : 
                                        <?php if(!empty($catalog->tags)): ?>
                                            <?php echo wCatalogToStringToLink($catalog->tags, _route('item:index'), 'tag')?>
                                        <?php else:?>
                                            None
                                        <?php endif?>
                                    </li>
                                    <li class="mt-3"></li>
                                    <li>Authors : 
                                        <?php if(!empty($catalog->authors)): ?>
                                            <?php echo wCatalogToStringToLink($catalog->authors, _route('item:index'), 'author')?>
                                        <?php else:?>
                                            None
                                        <?php endif?>
                                    </li>
                                    <li>Publishers :
                                        <?php if(!empty($catalog->publishers)): ?>
                                            <?php echo wCatalogToStringToLink($catalog->publishers, _route('item:index'), 'publishers')?>
                                        <?php else:?>
                                            None
                                        <?php endif?>
                                    </li>
                                    <li>Uploader : <a href="#"><?php echo $catalog->uploader_name?></a></li>
                                    <li class="mt-3">
                                        <?php echo wLinkDefault(_route('item:read', $catalog->id), 'Read ('.$catalog->read_total.')')?> | 
                                        <?php echo wLinkDefault(_route('item:like', $catalog->id), 'Like ('.$catalog->like_total.')')?> | 
                                        Views : <?php echo $catalog->view_total?>
                                    </li>
                                </ul>
                                <?php Flash::show('item-like')?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5>Description</h5>
                        <div  class="mt-3 mb-2">
                            <img src="<?php echo $catalog->qr_link?>" alt="" style="display:block;">
                            <?php echo wLinkDefault('/ItemController/printQR/'.$catalog->id, 'Print QR', [
                                'icon' => 'printer',
                                'target' => '_blank'
                            ])?>
                        </div>

                        <?php echo $catalog->description?>
                        <?php echo wDivider()?>
                        <small><strong>Reference </strong>: <?php echo $catalog->reference?></small>
                    </div>
                    <?php if($userUploads) :?>
                    <div class="mt-5">
                        <h5>Catalogs Uploaded By same user</h5>
                        <ul class="list-group">
                            <?php foreach($userUploads as $key => $row) :?>
                                <li class="list-group-item">
                                    <a href="<?php echo _route('item:show', $row->id)?>"><?php echo $row->title?></a>
                                    <div><strong><small><?php echo $row->genre?></small></strong> <small><?php echo $row->tags?></small></div>
                                    <small><?php echo $row->authors?></small>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                    <?php endif?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Comments</h4>
                </div>
                <div class="card-body">
                    <?php echo $_formComment->getForm('col');?>
                    <?php echo wDivider('30')?>
                    <ul class="list-group list-group-flush">
                        <?php foreach($comments as $key => $comment) :?>
                            <li class="list-group-item">
                                <div><strong><small><?php echo $comment->commentor_name?></small></strong></div>
                                <?php echo $comment->comment?>
                                <div><a href="<?php echo _route('item-comment:like', $comment->comment_id)?>"><small>Like <?php echo $comment->total_like?> </small></a> | <a href="#"><small>Comment</small></a> Posted On : <?php echo time_since($comment->posted_date) ?></div>
                            </li>
                        <?php endforeach?>
                    </ul>
                    <?php Flash::show('comment-like')?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Related Catalogs</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach($relatedCatalogs as $key => $row) :?>
                            <li class="list-group-item">
                                <a href="<?php echo _route('item:show', $row->id)?>"><?php echo $row->title?></a>
                                <div><strong><small><?php echo $row->genre?></small></strong> <small><?php echo $row->tags?></small></div>
                                <small><?php echo $row->authors?></small>
                            </li>
                        <?php endforeach?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('styles')?>
    <style type="text/css">
        #catalog_detail{
            display: flex;
            flex-direction: row;
        }

        @media (max-width:1400px)  {
             /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */ 
            #catalog_detail{
                all: unset;
            }
        }

        @media (min-width:414px and max-width:763px)  {
             /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */ 
            #catalog_detail{
                all: unset;
            }
        }
    </style>
<?php endbuild()?>
<?php loadTo()?>