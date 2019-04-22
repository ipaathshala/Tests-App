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
    <?php require_once('require/header-css.php');?>
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
                  <h4 class="page-title">Student Test</h4>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-20">
                  <div class="card-body">
                    <form>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <select class="form-control select2" id="batch" name="batch">
                              <option value="0">Select Batch</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <select class="form-control select2" id="exam" name="exam">
                              <option value="0">Select Exam</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <select class="select2 form-control select2-multiple" multiple="multiple" multiple="multiple" data-placeholder="Choose Student" id="student" name="student[]">
                              <option value="0">Select Student</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group text-right">
                            <button type="button" class="btn btn-dark waves-effect waves-light addRow"><i class="fas fa-plus"></i> ADD EXAM DETAIL</button>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <table class="table table-hover table-bordered mb-10 text-center">
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
                        <div class="col-lg-12">
                          <div class="form-group text-center">
                            <i class="fa fa-spinner fa-spin" id="loader"></i>
                            <button type="submit" name="submit" class="btn btn-dark waves-effect waves-light">SAVE RECORD</button>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <div class="alert alert-danger" role="alert" id="invbatch"><strong>Error! Invalid batch name</strong></div>
                            <div class="alert alert-danger" role="alert" id="invstudent"><strong>Error! Invalid student name</strong></div>
                            <div class="alert alert-danger" role="alert" id="invexam"><strong>Error! Invalid exam name</strong></div>
                            <div class="alert alert-danger" role="alert" id="invdate"><strong>Error! Invalid date format</strong></div>
                            <div class="alert alert-danger" role="alert" id="duplicate"><strong>Error! Exam already scheduled</strong></div>
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
    <!-- END wrapper -->
    <!-- jQuery  -->
    <?php require_once('require/footer-js.php');?>
    <!-- Plugins js -->
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Plugins Init js -->
    <script src="assets/pages/form-advanced.js"></script>
    <script src="mcq-js/student-exam.js"></script>
  </body>
</html>