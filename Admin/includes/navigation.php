<body id="page-top">
 <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <?php if(has_permission('admin') || has_permission('editor') ):?>
         <a class="navbar-brand" href="/clothing_store/index.php">Alchemy Admin</a>
         <?php endif;?>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarCollapse">
           <ul class="navbar-nav mr-auto">
            <?php if(has_permission('admin') || has_permission('editor') ):?>
              <li class="nav-item">
               <a class="nav-link" href="index.php">My Dashboard<span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="brands.php">Brands<span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="categories.php">Categories</a>
             </li>
             <li class="nav-item dropdown">
               <a class="nav-link" href="products.php">Products<span class="carat"></span></a>
             </li>
              <li class="nav-item">
               <a class="nav-link" href="landlords.php">houses</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="blog.php">Blog</a>
             </li>
           <?php endif ;?>
             <?php if(has_permission('admin')):?>
             <li class="nav-item dropdown">
               <a class="nav-link" href="users.php">Users<span class="carat"></span></a>
             </li>
           <?php endif;?>
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['first'].'!';?></a>
               <ul class="dropdown-menu" role="menu">
                  <li><a href="changePassword.php">Change Password</a></li>
                  <li><a href="logout.php">Log Out</a></li>
               </ul>
             </li>
             
           </ul>
         </div>
       </nav>
  <section>
    <div class="container-fluid">
      

       
         