<?php build('content') ?>
<div class="col-sm-12 col-md-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <?php Form::open(['method' => 'post', 'url' => _route('auth:login')])?>
                <?php Flash::show()?>
                <?php Form::hidden('login_type', 'admin')?>
                <?php echo wDivider(80)?>
                    <div class="text-center mb-3">
                        <h4 class="mb-3">ADMIN LOGIN</h4>
                        <img src="https://static.liveperson.com/static-assets/2022/02/11140627/Security_1-Photo-KS_02-11%402x.png"
                            height="150px">
                    </div>
                    <div class="form-group"><?php echo $form->getRow('email');?></div>
                    <div class="form-group"><?php echo $form->getRow('password');?></div>
                    <div class="form-group mt-3">
                        <?php echo Form::submit('', 'Login')?>
                    </div>
                <?php echo wDivider(80)?>
            <?php __( $form->end() )?>    
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>