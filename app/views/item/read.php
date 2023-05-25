<?php build('content')?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Read : <?php echo $catalog->title?></h4>
            <?php echo wLinkDefault(_route('item:show', $catalog->id), 'Back to Catalog')?>
            <div>Reading as : User AA</div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <iframe src="<?php echo $catalog->document->full_url?>#toolbar=0&navpanes=0" 
                    frameborder="0" 
                    style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:1000px;width:100%;" 
                    height="150%" width="150%"></iframe>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('script')?>
    <script>
        document.oncontextmenu = function() { 
            return false; 
        };

        $(function(){
            $('#download').hide();
        });
    </script>
<?php endbuild()?>

<?php build('stlyes')?>
<style>
    @media print
    {
        iframe {display:none;}
    }
</style>
<?php endbuild()?>
<?php loadTo()?>