<?php build('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">My Catalog</h4>
        <small>Total Catalog : <?php echo count($catalogs)?></small>
    </div>

    <div class="card-body">
        <div class="row">
            <?php foreach($catalogs as $catalog) :?>
                <div class="col-md-3 " style="padding:2px;border-radius:5px; margin-right:10px">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                <a href="<?php echo _route('item:show', $catalog->id)?>" style="text-decoration:underline"><?php echo $catalog->title?></a>
                            </h5>
                            <small><?php echo $catalog->year?></small>

                            <p><?php echo crop_words($catalog->brief, 50)?></p>

                            <div><small>(<?php echo $catalog->genre?>)</small></div>
                            <div><small><?php echo $catalog->tags?></small></div>
                            <div><a href="#"><?php echo $catalog->authors?></a></div>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo()?>