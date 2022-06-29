<?php require APPROOT.'/views/inc/header.php';?>

<h1><?=$data['post']->title;?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?=$data['user']->name; ?> on <?=$data['post']->created_at;?>
</div>
<p><?=$data['post']->body;?></p>

<hr>
    <div class="row">
    <div class="col-4">
        <a href="<?=URLROOT;?>/posts" class="btn btn-outline-secondary w-100"><i class="fa fa-backwards"></i> Back</a>
    </div>
    <?php if($data['post']->user_id == $_SESSION['user_id']){ ?>
    <div class="col">
        <a href="<?= URLROOT;?>/posts/edit/<?=$data['post']->post_id;?>" class="btn btn-dark w-100"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="col">
        <form action="<?=URLROOT;?>/posts/delete/<?=$data['post']->post_id;?>" method="POST">
            <input type="submit" class="btn btn-danger w-100" value="Delete">
        </form>
    </div>
    <?php } ?>
    </div>

<?php require APPROOT.'/views/inc/footer.php';?>
