<?php
//ob_start();
//session_start();

   include("../../includes/layouts/dairy_header_layout.php");
   
    //getting the dboperation class

?>
<div class="container-fluid user-dashboard">
              <div class="row">
                          <div class="col-lg-12">
                            
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Details of the Cattle</h4>
                                    <p class="category">This product will appear as what you produce</p>
                                </div>
                            
                                
                               
                                  
                                <form action="add_new_product.php" method="post">
                                  <div class="panel  panel-default">
                                    <div class="panel-heading card-header">
                                      <h3 class="panel-title title">Breed Description</h3>
                                    </div>
                                    <div class="panel-body">
                                    <div class="form-group ">
                                        <label for="formGroupExampleInput">Total Number of Chicks</label>
                                        <input type="text" class="form-control"  id="brand_name" name="brand_name"  placeholder="">
                                      </div>
                                      <div class="form-group ">
                                      
                                                            
                                      <div class="form-group ">
                                        <label for="formGroupExampleInput">Type of Breed</label>
                                        <select class="form-control" id="country" name="country" >
                                          <option>SELECT</option>
                                          <option>Bloiler</option>
                                          <option>hybrid</option>
                                          <option>Local</option>
                                          <option>for hachery</option>
                                          <option>for eggs</option>
                                        </select>
                                      </div>
                                      <div class="form-group ">
                                        <label for="formGroupProductName">Barcode/Registration number</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"  placeholder="">
                                      </div>
                                      <div class="form-group ">
                                        <label for="formGroupExampleInput">How many</label>
                                        <input type="text" class="form-control"  id="brand_name" name="brand_name"  placeholder="">
                                      </div>
                        
                                      <div class="form-group ">
                                        <label for="exampleFormControlTextarea1">Breed Purpose Statement</label>
                                        <textarea class="form-control"  id="product_purpose_statement" name="product_purpose_statement" value="<?= isset($_POST['product_purpose_statement']) ? $_POST['product_purpose_statement'] : ''; ?>" rows="3"></textarea>
                                      </div>
                                      <div class="form-group ">
                                        <label for="exampleFormControlTextarea1">Breed Description</label>
                                        <textarea class="form-control"  id="product_description" name="product_description" value="<?= isset($_POST['product_description']) ? $_POST['product_description'] : ''; ?>" rows="3"></textarea>
                                      </div>
                                    </div>

                                  </div>
                                  <br />



                                  <div class="panel panel-default">
                                    <div class="panel-heading card-header">
                                      <h3 class="panel-title title">Breed Production Details</h3>
                                    </div>
                                    <div class="panel-body">
                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">Est. of Monthly Quantity Produced. <small>every month</small></label>
                                    <input type="text" class="form-control" id="monthly_qty_production"  id="monthly_qty_production" name="monthly_qty_production" value="<?= isset($_POST['monthly_qty_production']) ? $_POST['monthly_qty_production'] : ''; ?>" placeholder="">
                                  </div>

                                  <div class="form-group  ">
                                    <label for="exampleFormControlSelect1">Quantity is measured in</label>
                                    <select class="form-control"  id="quantity_measurements" name="quantity_measurements" value="<?= isset($_POST['quantity_measurements']) ? $_POST['quantity_measurements'] : ''; ?>">
                                      <option>Weight</option>
                                      <option>Numbers</option>
                                      <option>Flocks</option>

                                    </select>
                                  </div>

                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">Current Product Manufacturing Capacity</label>
                                    <input type="text" class="form-control"  id="product_manu_capacity" name="product_manu_capacity" value="<?= isset($_POST['product_manu_capacity']) ? $_POST['product_manu_capacity'] : ''; ?>" placeholder="">
                                  </div>

                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">Current Product Quantinty in Storage.<small>as of Today.</small></label>
                                    <input type="text" class="form-control" id="current_quantinty_instorage" name="current_quantinty_instorage" value="<?= isset($_POST['current_quantinty_instorage']) ? $_POST['current_quantinty_instorage'] : ''; ?>" placeholder="">
                                  </div>

                                </div>
                              </div>
                              <br />
                              <div class="panel panel-default">
                                <div class="panel-heading card-header">
                                  <h3 class="panel-title title">Production Timeline</h3>
                                </div>
                                <div class="panel-body">

                                  <div class="form-group  ">
                                    <label for="formGroupExampleInput">day to update.</label>
                                    <input type="text" class="form-control" readonly id="next_day_update" name="next_day_update"   placeholder="">

                                    <small id="emailHelp" class="form-text text-muted">You will receive notifications to update info on this date.</small>
                                  </div>
                                  </div>

                                </div>
                              
                                <button type="submit" name="submit" class="btn btn-primary btn-lg"  value="Submit">Add new Product</button>
                                </form>

                               </div>
                         
                  </div>
               </div>
              
          </body>
          </html>
