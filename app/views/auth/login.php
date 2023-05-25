<?php build('content') ?>
    <div class="col-sm-12 col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div style="display:flex; flex-direction:row; align-items: center;">
                    <div style="flex:1; padding:20px" id="logoForBigScreen">
                        <div class="text-center">
                            <div class="mb-5"><?php echo wLogo('main', ['height' => 150 , 'width' => 150])?></div>
                            <h4>Technological University of the Philippines - Manila</h4>
                            <p>Ayala Boulevard, Ermita Manila www.tup.edu.ph</p>
                        </div>
                    </div>

                    <div style="flex:1">
                        <?php Form::open(['method' => 'post','url' => _route('auth:login')])?>
                            <?php Flash::show()?>
                            <?php echo wDivider(80)?>
                                <h4>Welcome To TUP Archive! <?php echo $loginType == 'admin' ? 'Admins' : 'Users'?></h4>
                                <div class="form-group"><?php echo $form->getCol('email');?></div>
                                <div class="form-group"><?php echo $form->getCol('password');?></div>
                                <div class="form-group mt-3">
                                    <?php echo Form::submit('', 'Login')?>
                                </div>

                                <?php echo wDivider('20')?>
                                <a href="<?php echo _route('forget-pw:index')?>">Forgot password?</a> <?php echo wDivider('20')?>
                                <label for="#">Don't have Account? <a href="<?php echo _route('auth:register')?>">Register Here.</a></label>
                            <?php echo wDivider(80)?>
                        <?php __( $form->end() )?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('styles')?>
    <style>
        
    </style>
<?php endbuild()?>
<?php loadTo('tmp/base')?>