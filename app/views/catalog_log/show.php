<?php build('content') ?>
<?php Flash::show()?>
    <div class="alert alert-danger">
        <div class="alert-text text-center">
            This Catalog is already deleted
            <div><a href="<?php echo _route('catalog-log:rollback', $id)?>" class="btn btn-success">Retrieve Catalog</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h4 class="card-title" style="display:inline-block"><?php echo $catalog->title?></h4>
                        <?php if($category->name) :?>
                            <span class="badge bg-primary">
                                <?php echo $category->name?>
                            </span>
                        <?php endif?>
                    </div>
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
                                    <li>Uploader : <a href="#"><?php echo $catalog->uploader->firstname?></a></li>
                                     <?php echo wLinkDefault(_route('item:read', $catalog->id), 'Read')?> | 
                                        <?php echo wLinkDefault(_route('item:like', $catalog->id), 'Like')?>
                                </ul>
                                <?php Flash::show('item-like')?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5>Description</h5>
                        <img src="<?php echo $catalog->qr_link?>" alt="" style="display:block;" class="mt-3 mb-2">
                        <?php echo $catalog->description?>
                        <?php echo wDivider()?>
                        <small><strong>Reference </strong>: <?php echo $catalog->reference?></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Document</h4>
                </div>

                <div class="card-body">
                    <iframe src="<?php echo $catalog->document->full_url?>#toolbar=0&navpanes=0" 
                        frameborder="0" 
                        style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:1000px;width:100%;" 
                        height="150%" width="150%"></iframe>  
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