<?php require APPROOT.'/views/inc/header.php';?>

<h1><?php echo $data['title']; ?></h1>
<p class="lead"><?=$data['desc'];?></p>
<p>Version: <strong><?=APPVERSION;?></strong></p>
<?php require APPROOT.'/view/inc/footer.php';?>