<?php
$electricity_check = ((isset($_REQUEST['electricity']))?sanitize($_REQUEST['electricity']):'');
$water_check = ((isset($_REQUEST['water']))?sanitize($_REQUEST['water']):'');
$warm_water = ((isset($_REQUEST['warm_water']))?sanitize($_REQUEST['warm_water']):'');
$cold_water = ((isset($_REQUEST['cold_water']))?sanitize($_REQUEST['cold_water']):'');
$plumbingI = ((isset($_REQUEST['plumbingI']))?sanitize($_REQUEST['plumbingI']):'');
$plumbingE = ((isset($_REQUEST['plumbingE']))?sanitize($_REQUEST['plumbingE']):'');
?>


                    
                    <div  class="container-fluid">
                      <h3 class="title text-center">Preference</h3>
                      <form action="h_search.php" method="post" id="preference_search">
                        <div class="row">
                          <div class="col-md-3">
                            <ul class="list-group">
                            <li class="list-group-item form-group">
                              <div class="form-check">                                                            
                                <input class="form-check-input" type="checkbox" name="electricity" value="electricity"<?=(($electricity_check == 'electricity')?' checked':'');?>>
                            <label class="form-check-label"> Electricity</label>
                            </div>
                            </li>
                           <li class="list-group-item">
                            <div class="form-check">
                              
                                <input class="form-check-input" type="checkbox" name="water" value="water"<?=(($water_check == 'water')?' checked':'');?>>
                              <label class="form-check-label"> Water</label>
                              
                             </div>
                          </li></ul>
                          </div>
                            <div class="col-md-4" >
                              <ul class="list-group">
                            <li class="list-group-item">
                            <div class="form-check">
                              
                               <input class="form-check-input" type="checkbox" name="warm_water" value="warm_water"<?=(($warm_water == 'warm_water')?' checked':'');?>>
                             <label class="form-check-label"> Warm shower </label>
                             
                            </div>
                            </li>
                            <li class="list-group-item">
                            <div class="form-check">                             
                               <input class="form-check-input" id="cold_water" type="checkbox" name="cold_water" value="cold_water"<?=(($cold_water == 'cold_water')?' checked':'');?>>  
                                 <label for="cold_water" class="form-check-label"> cold shower</label>
                            </div>
                            </li></ul>
                            </div>
                          <div class="col-md-5">
                             <ul class="list-group">
                            <li class="list-group-item">
                            <div class="form-check">
                             
                                <input class="form-check-input" type="checkbox" name="plumbingI" value="plumbingI"<?=(($plumbingI == 'plumbingI')?' checked':'');?>>  
                                 <label class="form-check-label"> Indoor plumbing (washroom)</label>
                           
                            </div>
                            </li>
                            <li class="list-group-item">
                            <div class="form-check">
                              
                                 <input id="plumbingE" class="form-check-input" type="checkbox" name="plumbingE" value="plumbingE"<?=(($plumbingE == 'plumbingE')?' checked':'');?>>
                               <label for="plumbingE" class="form-check-label"> External plumbing
                              </label>
                            </div>
                            </li></ul>
                          </div>

                           <div class="col-md-3">
                              <ul class="list-group" style="margin-top: 12px;">
                            <li class="list-group-item">
                           <div class="form-check">
                              <label style="margin-left: -20px;" for="room" class="form-check-label"> Rooms:</label>                                                    
                              <input style="width: 50px;height: 25px;margin-top: -20px;margin-left: 50px;font-size: 12px;" max="7" min="1" class="form-control form-check-input" id="room" type="number" name="room">
                            </div></li>
                            <li class="list-group-item">
                              <label for="month_availability">Month Available: </label>
                            <input type="date" class="form-control" id="month_availability" name="month"></li>
                          </ul>
                           </div>
                           <div class="col-md-4">
                             <button class="btn btn-info bg_btn" style="width: 160px;font-size: 18px;margin-top: 12px" type="submit"><i class="fa fa-search"></i> Search</button>
                           </div>
                           
                        </div>
                        
                      
                      </form>
                      
                    </div>
                </div>
        

        
           <footer class="footer">