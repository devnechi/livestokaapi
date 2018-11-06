
<?php
include("../../includes/layouts/hatchers_header_layout.php");


?>
<div class="container-fluid">

              <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Update Post Hatched Batch Data</h4>
                                    <p class="category">Once the Hatching Process is complete Hatchery Owners can enter a post results data.</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                                    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


                                <div class="container">
                                  <form>
                                      <div class="form-group col-md-6">
                                        <label for="formGroupExampleInput">Current Date:</label>
                                        <br />
                                        <label for="formGroupExampleInput">Time:</label>

                                        <div class="form-group col-md-6">
                                          <label for="formGroupExampleInput">Hatching Process in Days.<small> the 21 - 23 days of hatching</small></label>
                                          <input type="text" class="form-control" id="formGroupExampleInput" placeholder="DAY 1: Setting of Eggs">
                                        </div>
                                      </div>

                                    <div class="form-group col-md-6">
                                      <label for="exampleFormControlSelect1">Select Created Batch</label>
                                      <select class="form-control" id="exampleFormControlSelect1">
                                        <option>SELECT</option>
                                        <option>batch 0023|breedA|daycreated|status</option>
                                        <option>batch 0027|breedA|daycreated|status</option>
                                        <option>batch 0028|breedB|daycreated|status</option>
                                        <option>batch 0029|breedC|daycreated|status</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="formGroupExampleInput">Number of Eggs on Setter:</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label for="exampleFormControlTextarea1"> DAY {for hatching process}</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label for="formGroupExampleInput"> Original Number of Eggs on Setter</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label for="formGroupExampleInput"> Number of Eggs Hatched. </label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label for="formGroupExampleInput">Number of Damaged Eggs</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>


                                    <!-- <div class="form-group">
                                      <label for="exampleFormControlSelect1">Product Texture</label>
                                      <select class="form-control" id="exampleFormControlSelect1">
                                        <option>SELECT</option>
                                        <option>Mash</option>
                                        <option>Pellets</option>

                                      </select>
                                    </div> -->

                                    <div class="form-group">
                                      <label for="formGroupExampleInput">Est. Weight of Hatched Chicks</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label for="formGroupExampleInput">Final Temperature</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label for="formGroupExampleInput">Final Humidity</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label for="formGroupExampleInput">Breeder Flock Source</label>
                                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-lg">Create New Batch</button>

                                  </form>
                              </div>
                          </div>
          </div>
        </div>


          </body>
          </html>
