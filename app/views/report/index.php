<?php build('content') ?>
    <h4>Reports</h4>
    <ul>
        <li><a href="<?php echo _route('report:sales')?>">Sales report</a></li>
        <li><a href="<?php echo _route('report:stocks')?>">Inventory report</a></li>
    </ul>
<?php endbuild()?>

<?php loadTo()?>