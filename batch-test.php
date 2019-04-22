  <?php   
  include_once('includes/DB_Functions.php');
  $db = new DB_Functions();
  if(!($_SESSION["user_id"])){
  header("Location:logout");
  }
  ?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Batch Test</title>
    <!-- Plugins css -->
    <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <?php require_once('require/header-css.php'); ?>
  </head>
  <body>
    <div id="wrapper">
      <?php
        require_once('require/top-bar.php');
        require_once('require/sidebar.php');
        ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-title-box">
                  <h4 class="page-title">Batch Test</h4>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-20">
                  <div class="card-body">
                    <form>
                      <div class="row">
                        <div class="col-lg-5">
                          <div class="form-group">
                            <select class="form-control select2" id="batch" name="batch">
                              <option value="0">Select Batch</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            <select class="form-control select2" id="exam" name="exam">
                              <option value="0">Select Exam</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group text-center">
                            <button type="button" class="btn btn-dark waves-effect waves-light addRow"><i class="fas fa-plus"></i> ADD EXAM DETAIL</button>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <table class="table table-hover table-bordered mb-0 text-center">
                            <thead>
                              <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="examDetails">
                            </tbody>
                          </table>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-lg-12">
                          <div class="form-group text-center">
                            <br>
                            <i class="fa fa-spinner fa-spin" id="loader"></i>
                            <button type="submit" name="submit" class="btn btn-dark waves-effect waves-light">SAVE RECORD</button>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <div class="alert alert-danger" role="alert" id="invbatch"><strong>Error! Select batch</strong></div>
                            <div class="alert alert-danger" role="alert" id="invexam"><strong>Error! Select exam</strong></div>
                            <div class="alert alert-danger" role="alert" id="invdate"><strong>Error! Invalid date format</strong></div>
                            <div class="alert alert-danger" role="alert" id="duplicate"><strong>Error! Batch test already scheduled</strong></div>
                            <div class="alert alert-danger" role="alert" id="invalid"><strong>Error! Some error occurs unable to save record</strong></div>
                            <div class="alert alert-danger" role="alert" id="fail"><strong>Error! Unable to proceed your request</strong></div>
                            <div class="alert alert-success" role="alert" id="success"><strong>Success! Record saved successfully</strong></div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once('require/footer.php');?>
      </div>
    </div>
    <!-- jQuery  -->
    <?php require_once('require/footer-js.php');?>
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/pages/form-advanced.js"></script>
    <script src="mcq-js/batch-test.js"></script>
  </body>
</html>