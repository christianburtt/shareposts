<?php require APPROOT.'/views/inc/header.php';?>
<div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Write your latest post here.</p>
    <form action="<?=URLROOT.'/posts/add';?>" method="POST" class="form">
        
        <div class="form-group mb-2">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid':'';?>" value="<?=$data['title'];?>">
            <span class="invalid-feedback"><?=$data['title_err'];?></span>
        </div>
        <div class="form-group mb-2">
            <label for="body">Post Text: <sup>*</sup></label>
            <textarea  name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid':'';?>"><?=$data['body'];?></textarea>
            <span class="invalid-feedback"><?=$data['body_err'];?></span>
        </div>
        
        <div class="row form-row">
            <div class="col">
                <input type="submit" value="Save" class="btn btn-success w-100">
            </div>
            <div class="col">
                <a href="<?=URLROOT.'/posts';?>" class="btn btn-outline-dark w-100"><i class='fa fa-ban'></i> Cancel</a>
            </div>
        </div>
    </form>
</div>


<?php require APPROOT.'/views/inc/footer.php';?>
