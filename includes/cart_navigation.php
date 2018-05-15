<?php
$sql ="SELECT * FROM categories WHERE parent = 0";
$parentquery = $db->query($sql);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Alchemy 254</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> 

  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav text-uppercase ml-auto">

        <?php while ($parent = mysqli_fetch_assoc($parentquery)):?>
          <?php
          $parent_id = $parent['id'];
          $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
          $childquery = $db->query($sql2);
          ?>
        
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><?php echo $parent['categories'];?><span class="carat"></span></a>
        <ul class="dropdown-menu" role="menu">
          <?php while ($child =  mysqli_fetch_assoc($childquery)) : ?>                  
          <li><a class="dropdown-item js-scroll-trigger" href="category.php?cat=<?=$child['id'];?>"><?php echo $child['categories'];?></a></li>
          <?php endwhile;?>
        </ul>
      </li>
    <?php endwhile;?>
    <li class="nav-item">
      <a href="cart.php" class="nav-link"><span class="glyphicon-shopping-cart"></span>My Cart</a>
    </li>
      <li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
      </li>
    </ul>
  </div>
</nav>