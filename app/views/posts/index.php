<?php require APPROOT.'/views/inc/header.php';?>
<?php flash('post_message');?>
<div class="row mb-3">
    <div class="col">
        <h1>Posts</h1>

    </div>
    <div class="col">
        <a href="<?php echo URLROOT;?>/posts/add" class="btn btn-outline-primary pull-right"><i class='fa fa-pencil'></i> Add Post</a>
    </div>
</div>
<?php
foreach($data['posts'] as $post) : ?>
<div class="card card-body mb-3">
    <h4 class="card-title"><?=$post->title;?></h4>
    <div class="bg-light p-2 mb-3">
        written by <?=$post->name;?> on <?=$post->created_at;?>
    </div>
    <p class="card-text"><?php if(strlen($post->body) > 64){ 
        echo substr($post->body,0,64)."...";
    }else{
        echo $post->body;
        }?></p>
    <a href="<?= URLROOT;?>/posts/show/<?=$post->post_id;?>" class="btn btn-dark">More</a>
</div>
<?php endforeach;?>
<?php require APPROOT.'/views/inc/footer.php';?>
