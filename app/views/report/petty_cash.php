<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sales Report</h4>
        </div>
        <div class="card-body">
            <div class="col-md-7">
                <div class="report_container">    
                    <section class="header">
                        <div class="text-center">
                            <h4>PETTY CASH REPORT</h4>
                            <div><small>AS of 2022-07-31 : 10:19AM</small></div>
                            <div>Report By : <small><strong>Mark Angelo Gonzales(110010)</strong></small></div>
                        </div>
                    </section>
                    
                    <section class="summary">
                        <table class="table table-bordered">
                            <tr>
                                <td>HIGHEST SPENDING CATEGORY</td>
                                <td>LOWEST SPENDING CATEGORY</td>
                            </tr>

                            <tr>
                                <td>
                                    <ul>
                                        <li>#1 TRANSPORTATION : 3,000.00</li>
                                        <li>#2 FOOD ALLOWANCE : 6,000.00</li>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                        <li>#1 REFUNDS : 300.00</li>
                                        <li>#2 MISC : 300.00</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </section>

                    <section class="particulars">
                        <h4>Particulars</h4>
                        <table class="table table-bordered">
                            <thead>
                                <th>Staff</th>
                                <th>Category + Desc</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </thead>
                        </table>
                    </section>
                </div>
            </div>

        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>