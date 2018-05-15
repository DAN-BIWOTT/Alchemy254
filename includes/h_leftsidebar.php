<?php
require_once 'core/init.php';

$locationSql = $db->query("SELECT * FROM location");
?>
<section class="creative_feature_area" style="margin-top: -150px;">
    <div class="container">
        <div class="c_feature_box">
            <div class="row">
                <div class="col-lg-4">
                    <div class="c_box_item">
                        <a href="#"><h4><i class="fa fa-globe" aria-hidden="true"></i> Location</h4></a>
                        <p><div class="list-group">
                          <?php while($location = mysqli_fetch_assoc($locationSql)) : ?>
                          <a href="location_search.php?loc=<?=$location['name'];?>" class="list-group-item list-group-item-action"><?= $location['name'] ?></a>
                        <?php endwhile; ?>
                        </div> </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="c_box_item">
                        <a href="#"><h4><i class="fa fa-money" aria-hidden="true"></i> Rent</h4></a>
                        <p> <div class="list-group"  id="navbarCollapse">
                        <?php include 'widgets/h_filters.php' ;?>
                      </div></p>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <?php include 'h_rightsidebar.php' ;?>
              </div>
            </div>
        </div>
       
    </div>
</section>

           