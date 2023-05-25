<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sales Report</h4>
        </div>
        <?php if(isset($isSummarized)) :?>
        <div class="card-body">
            <div class="col-md-7">
                <div class="report_container">    
                    <section class="header">
                        <div class="text-center">
                            <h4>SALES REPORT</h4>
                            <div>Report Period : <?php echo $request['start_date']?> TO <?php echo $request['end_date']?></div>
                            <?php if(!is_null($user)) :?>
                                <div>For User : <?php echo $user->firstname . ' '.$user->lastname?></div>
                            <?php endif?>
                            <div><small>AS of <?php echo $reportData['today']?></small></div>
                            <div>Report By : <small><strong><?php echo $reportData['user']?></strong></small></div>
                        </div>
                    </section>
                    
                    <section class="summary">
                        <table class="table table-bordered">
                            <tr>
                                <td>TOTAL SALES IN AMOUNT</td>
                                <td><?php echo amountHTML($reportData['salesSummary']['totalSalesInAmount'])?></td>
                            </tr>
                            <tr>
                                <td>TOTAL SALES IN QUANTITY</td>
                                <td><?php echo $reportData['salesSummary']['totalSalesInQuantity']?></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2">HIGHEST SELLING ITEMS</td>
                            </tr>

                            <tr>
                                <td>IN QUANTITY</td>
                                <td>IN AMOUNT</td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <?php foreach($reportData['highestSellingInQuantity'] as $key => $row) :?>
                                            <li><small><?php echo $row->sku?></small><?php echo $row->item_name?> (<?php echo $row->total_quantity?>) Items</li>
                                        <?php endforeach?>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                    <?php foreach($reportData['highestSellingInAmount'] as $key => $row) :?>
                                            <li><small><?php echo $row->sku?></small><?php echo $row->item_name?> (<?php echo amountHTML($row->total_amount)?>) Items</li>
                                        <?php endforeach?>
                                    </ul>
                                </td>
                            </tr>

                            <tr align="center">
                                <td colspan="2">LOWEST SELLING ITEMS</td>
                            </tr>

                            <tr>
                                <td>IN QUANTITY</td>
                                <td>IN AMOUNT</td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <?php foreach($reportData['lowestSellingInQuantity'] as $key => $row) :?>
                                            <li><small><?php echo $row->sku?></small><?php echo $row->item_name?> (<?php echo $row->total_quantity?>) Items</li>
                                        <?php endforeach?>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                    <?php foreach($reportData['lowestSellingInAmount'] as $key => $row) :?>
                                            <li><small><?php echo $row->sku?></small><?php echo $row->item_name?> (<?php echo amountHTML($row->total_amount)?>) Items</li>
                                        <?php endforeach?>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </section>

                    <section class="summary">
                        <h4 class="mt-2">Breakdown</h4>

                        <table class="table table-bordered">
                            <thead>
                                <th>Item+SKU</th>
                                <th>Quantity</th>
                                <th>Sell Price</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <?php foreach($reportData['saleItems'] as $key => $row) :?>
                                    <tr>
                                        <td><?php echo $row->item_name.'('.$row->sku.')'?></td>
                                        <td><?php echo $row->quantity?></td>
                                        <td><?php echo amountHTML($row->price)?></td>
                                        <td><?php echo amountHTML($row->discount_price)?></td>
                                        <td><?php echo amountHTML($row->sold_price)?></td>
                                    </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

        </div>

        <?php else:?>

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
                    <?php echo $_formCommon->getRow('user_id')?>
                    <?php echo $_formCommon->get('submit')?>
                <?php Form::close()?>
            </div>
        </div>
        <?php endif?>
    </div>
<?php endbuild()?>
<?php loadTo()?>