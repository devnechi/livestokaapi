
<?php
include("../../includes/layouts/main_hatchery_header.php");


?>
<div class="container-fluid">

              <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Create New Hatching Batch</h4>
                                    <p class="category">setting eggs on a hatchery</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                                    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

                                    <form>

                                          <div class="form-group">
                                            <label for="formGroupExampleInput"><strong>Hatchery Description</strong></label>
                                             <!-- <hr> -->
                                          </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="lblcompany_name">Hatchery Name</label>
                                                  <input type="text" class="form-control" id="companyname" name="hatchery_name" value="<?= isset($_POST['hatchery_name']) ? $_POST['hatchery_name'] : ''; ?>" placeholder="">
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="formGroupExampleInput2">Type of Ownership</label>
                                                   <select class="form-control" id="country" name="country" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>">
                                                     <option>SELECT</option>
                                                     <option>Sole Proprietorship (individual or family)</option>
                                                     <option>Liability Company</option>
                                                     <option>Non-Liability (NGO, Government, project etc)</option>
                                                   </select>

                                                </div>
                                              </div>
                                            </div>
                                    </form>

          </div>
        </div>


        <?php
                        include("../../includes/layouts/hatchery_main_footer.php");
                         ?>
