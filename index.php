<?php include_once('header.php');?>
  <div class="all-content">
    <div class="left-admin-menu">
    <?php if($_SESSION['isAdmin']){ ?>
    <?php include_once('admin-menu.php');?>
    <?php } ?>
    </div>
    <div class="main-content">
      <h1> Here goes the actual content </h1>
    </div>
  </div>

<?php include_once('footer.php'); ?>