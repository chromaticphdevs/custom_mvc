<?php build('content') ?>
    <div class="container">
        <div class="card">
            <?php
                echo Form::open([
                    'method' => 'post'
                ]);
            ?>
            <div class="card-body">
                <?php Flash::show()?>
                <div class="text-center">
                    <div class="mb-5"><?php echo wLogo()?></div>
                    <h4>Register to TUP Archiving System</h4>
                    <p>And have access to our <?php echo $totalCatalog?>++ catalogs</p>
                </div>
                <?php echo wDivider(80)?>
                <div class="col-md-8 mx-auto">
                    <?php echo wLinkDefault(_route('auth:login'), 'Back To Login')?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><?php echo $_form->getCol('firstname');?></div>
                            <div class="col-md-4"><?php echo $_form->getCol('lastname');?></div>
                            <div class="col-md-4"><?php echo $_form->getCol('user_identification');?></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col-md-6"><?php echo $_form->getCol('email');?></div>
                            <div class="col-md-6">
                                <?php echo $_form->getCol('password');?>
                                <?php
                                    Form::password('confirm_password', '', [
                                        'class' => 'form-control',
                                        'required' => true,
                                        'placeholder' => 'Confirm Password'
                                    ])
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <?php echo Form::submit('', 'Register')?>
                    </div>
                </div>
                <?php echo wDivider(80)?>
            </div>

            <?php echo Form::close()?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>