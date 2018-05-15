 <?php
 $sql ="SELECT * FROM categories WHERE parent = 0"; 
 $parentquery = $db->query($sql);
 ?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">Alchemy 254</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
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
            <a href="cart.php" class="nav-link"><i class="fa fa-shopping-cart"></i> My Cart</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="blogIndex.php">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
            </li>
            <?php if(!is_logged_in()) :?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-user"></i> Account
              </a>              
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="Admin/login.php">Log In</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="Admin/register.php">Register</a>
              </div>
              </li>
            <?php else: ?>
              <li class="nav-item">
              <a class="nav-link" href="landlords/landlord_home.php"><img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON"> Profile </a>
            </li>
            <?php endif ;?>
          </ul>
        </div>
      </div>
    </nav>