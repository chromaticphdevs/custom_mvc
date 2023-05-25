<?php build('content') ?>
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <?php Flash::show()?>
                    <div class="text-center">
                        <h4>Enter Verification Code</h4>
                        <?php  Form::open(['method' => 'post'])?>
                            <div class="form-group mt-3">
                                <?php Form::text('verification_code', '' , ['class' => 'form-control form-control-lg','placeholder' => 'Enter 4 Digit Verification Code'])?>
                            </div>
                            <div class="form-group mt-4">
                                <?php Form::submit('', 'Verify Code')?>
                            </div>
                        <?php  Form::close()?>
                    </div>
                </div>

                <?php echo wDivider(80)?>
                <?php echo wLogo('wide')?>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>