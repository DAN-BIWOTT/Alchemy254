

   <header class="main_menu_area">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="max-height: 90px;">
                <a class="navbar-brand" href="index.php"><img src="images/icons/4.png" alt="" style="max-height: 90px;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    
                </button>

              <div class="collapse navbar-collapse" id="navbarResponsive" > 
                <ul class="navbar-nav mr-auto">
                  <?php if((has_permission('admin') || has_permission('editor') || has_permission('landlord')) &&is_logged_in() ):?>
                  <li class="nav-item ">
                    <a class="nav-link" href="landlords/landlord_home.php" style="font-size: 18px;"><img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON"> Profile</a>
                  </li>
                  <?php else :?>            
                   <li class="nav-item ">
                    <a class="nav-link" href="Admin/login.php" style="font-size: 18px;">Log In</a>
                  </li>
                   <li class="nav-item ">
                    <a class="nav-link" href="Admin/register.php" style="font-size: 18px;">Register</a>
                  </li>
                 <?php endif;?>
                </ul>
              </div>
            </nav>
        </header>
