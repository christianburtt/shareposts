<?php require APPROOT.'/views/inc/header.php';?>
<div class="row">
    <div class="col-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <form action="<?=URLROOT.'/users/login';?>" method="POST" class="form">
                
                <div class="form-group mb-2">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid':'';?>" value="<?=$data['email'];?>">
                    <span class="invalid-feedback"><?=$data['email_err'];?></span>
                </div>
                <div class="form-group mb-2">
                    <label for="pw">Password: <sup>*</sup></label>
                    <input type="password" name="pw" class="form-control form-control-lg <?php echo (!empty($data['pw_err'])) ? 'is-invalid':'';?>" value="<?=$data['pw'];?>">
                    <span class="invalid-feedback"><?=$data['pw_err'];?></span>
                </div>
                
                <div class="row form-row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success w-100">
                    </div>
                    <div class="col">
                        <a href="<?=URLROOT.'/users/register';?>" class="btn btn-outline-dark w-100">Don't have an Account? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT.'/view/inc/footer.php';?>