<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="<?= URLROOT;?>" class="d-flex align-items-center mb-3 mb-md-0 text-dark text-decoration-none">
        <span class="fs-4"><?=SITENAME; ?></span>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto justify-content-start mb-2 mb-md-0">
        <li class="nav-item"><a href="<?=URLROOT;?>" class="nav-link" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="<?=URLROOT.'/pages/about';?>" class="nav-link">About</a></li>
      </ul>
      <?php if(isset($_SESSION['user_id'])){ ?>
        <ul class="nav text-end">
            <li class="nav-item"><a href="<?=URLROOT.'/users/logout';?>" class="nav-link">Logout <?php echo $_SESSION['user_name'];?></a></li>
         </ul>
       <?php }else{ ?>

        
      <ul class="nav text-end">
        <li class="nav-item"><a href="<?=URLROOT.'/users/register';?>" class="nav-link">Register</a></li>
        <li class="nav-item"><a href="<?=URLROOT.'/users/login';?>" class="nav-link">Login</a></li>
      </ul>
      <?php } ?>
    </header>