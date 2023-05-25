<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sales Report</h4>
        </div>

        <div class="card-body">
            <div class="col-md-5">
                <?php
                    Form::open([
                        'method' => 'get',
                        'action' => ''
                    ])
                ?>
                    <?php echo $_formCommon->getRow('start_date')?>
                    <?php echo $_formCommon->getRow('end_date')?>
                    <?php echo $_formCommon->get('submit')?>
                <?php Form::close()?>
            </div>
        </div>
        
        <?php if(isset($reportData)) :?>
            <?php extract($reportData) ?>
        <div class="card-body">
            <div class="col-md-7">
                <div class="report_container">    
                    <section class="header">
                        <div class="text-center">
                            <h4>STOCK REPORT</h4>
                            <div><small>AS of <?php echo $dateNow?></small></div>
                            <div>Report Period : <?php echo $request['start_date']?> TO <?php echo $request['end_date']?></div>
                            <div>Report By : <small><strong><?php echo $displayname?></strong></small></div>
                        </div>
                    </section>
                    <section class="summary">
                        <table class="table table-bordered">
                            <tr align="center">
                                <td colspan="5">HIGHEST STOCKS IN LEVEL</td>
                            </tr>
                            <tr>
                                <td>ITEM + SKU</td>
                                <td>MIN</td>
                                <td>MAX</td>
                                <td>STOCKS</td>
                                <td>LEVEL</td>
                            </tr>
                            <?php foreach($highestStockByMaxQuantity as $key => $row) :?>
                                <tr>
                                    <td><?php echo "{$row->name} ({$row->sku})"?></td>
                                    <td><?php echo $row->min_stock?></td>
                                    <td><?php echo $row->max_stock?></td>
                                    <td><?php echo $row->total_stock?></td>
                                    <td><?php echo $row->stock_level?></td>
                                </tr>
                            <?php endforeach?>
                            <tr align="center">
                                <td colspan="5">LOWEST STOCKS IN LEVEL</td>
                            </tr>
                            <tr>
                                <td>ITEM + SKU</td>
                                <td>MIN STOCK</td>
                                <td>MAX STOCK</td>
                                <td>STOCKS</td>
                                <td>LEVEL</td>
                            </tr>
                            <?php foreach($lowestStockByMaxQuantity as $key => $row) :?>
                                <tr>
                                    <td><?php echo "{$row->name} ({$row->sku})"?></td>
                                    <td><?php echo $row->min_stock?></td>
                                    <td><?php echo $row->max_stock?></td>
                                    <td><?php echo $row->total_stock?></td>
                                    <td><?php echo $row->stock_level?></td>
                                </tr>
                            <?php endforeach?>

                            <tr align="center">
                                <td colspan="5">HIGHEST STOCKS IN QUANTITY</td>
                            </tr>
                            <tr>
                                <td>ITEM + SKU</td>
                                <td>MIN STOCK</td>
                                <td>MAX STOCK</td>
                                <td>STOCKS</td>
                                <td>LEVEL</td>
                            </tr>

                            <?php foreach($highestStockByQuantity as $key => $row) :?>
                                <tr>
                                    <td><?php echo "{$row->name} ({$row->sku})"?></td>
                                    <td><?php echo $row->min_stock?></td>
                                    <td><?php echo $row->max_stock?></td>
                                    <td><?php echo $row->total_stock?></td>
                                    <td><?php echo $row->stock_level?></td>
                                </tr>
                            <?php endforeach?>

                            <tr align="center">
                                <td colspan="5">LOWEST STOCKS IN QUANTITY</td>
                            </tr>
                            <tr>
                                <td>ITEM + SKU</td>
                                <td>MIN STOCK</td>
                                <td>MAX STOCK</td>
                                <td>STOCKS</td>
                                <td>LEVEL</td>
                            </tr>

                            <?php foreach($lowestStockByQuantity as $key => $row) :?>
                                <tr>
                                    <td><?php echo "{$row->name} ({$row->sku})"?></td>
                                    <td><?php echo $row->min_stock?></td>
                                    <td><?php echo $row->max_stock?></td>
                                    <td><?php echo $row->total_stock?></td>
                                    <td><?php echo $row->stock_level?></td>
                                </tr>
                            <?php endforeach?>

                        </tbody>
                        </table>
                    </section>

                    <section class="particular">
                        <h4>Stocks</h4>
                        <?php $totalStock = 0?>
                        <small>ARRANGED BY HIHEST STOCK LEVEL AND STOCK</small>
                        <table class="table table-bordered">
                            <thead>
                                <td>ITEM + SKU</td>
                                <td>MIN</td>
                                <td>MAX</td>
                                <td>STOCK</td>
                                <td>LEVEL</td>
                            </thead>

                            <tbody>
                                <?php foreach($stocks as $key => $row) :?>
                                    <?php $totalStock += $row->total_stock?>
                                    <tr>
                                        <td><?php echo "{$row->name} ({$row->sku})"?></td>
                                        <td><?php echo $row->min_stock?></td>
                                        <td><?php echo $row->max_stock?></td>
                                        <td><?php echo $row->total_stock?></td>
                                        <td><?php echo $row->stock_level?></td>
                                    </tr>
                                <?php endforeach?>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td><?php echo $totalStock?></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

        </div>

        <?php endif?>
    </div>
<?php endbuild()?>
<?php loadTo()?>