<?php require APPROOT.'/views/inc/header.php';?>
<div class="px-4 py-5 my-5 text-center">
    <h1 class="display-3 fw-bold"><?php echo $data['title']; ?></h1>

    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4"><?=$data['desc'];?></p>
    </div>
</div>

<?php require APPROOT.'/view/inc/footer.php';?>