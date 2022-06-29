<?php require APPROOT.'/views/inc/header.php';?>
<div class="row">
    <div class="col-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create An Account</h2>
            <p>Please fill out the form to register with us.</p>
            <form action="<?=URLROOT.'/users/register';?>" method="POST" class="form">
                <div class="form-group mb-2">
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid':'';?>" value="<?=$data['name'];?>">
                    <span class="invalid-feedback"><?=$data['name_err'];?></span>
                </div>
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
                <div class="form-group mb-2">
                    <label for="confirm">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm" class="form-control form-control-lg <?php echo (!empty($data['confirm_err'])) ? 'is-invalid':'';?>" value="<?=$data['confirm'];?>">
                    <span class="invalid-feedback"><?=$data['confirm_err'];?></span>
                </div>
                <div class="row form-row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success w-100">
                    </div>
                    <div class="col">
                        <a href="<?=URLROOT.'/users/login';?>" class="btn btn-outline-dark w-100">Have an Account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT.'/view/inc/footer.php';?>