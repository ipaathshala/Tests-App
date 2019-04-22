  <?php   
  include_once('includes/DB_Functions.php');
  $db = new DB_Functions();
  error_reporting(0);
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
    <title>Question &amp; Answer</title>
    <!--CSS-->
    <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <?php require_once('require/header-css.php')?>
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
                  <h4 class="page-title">Set Test</h4>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-20">
                  <div class="card-body">
                    <form class="m-t-10">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <select class="form-control select2" id="exam" name="exam">
                              <option value="0">Select Exam</option>
                              <optgroup label="Type exam title"></optgroup>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <input type="file" class="filestyle" data-buttonname="btn-secondary" id="file" name="file" value="<?php echo $_POST['file'];?>">
                            <label class="control-label">(Upload question)</label> 
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <select class="form-control select2" id="ans" name="ans">
                              <option value="0">Select Answer Option</option>
                              <optgroup label="Select Answer">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                              </optgroup>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <select class="form-control select2" id="positive" name="positive">
                              <option value="0">Plus Marks</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <select class="form-control select2" id="negative" name="negative">
                              <option value="0">Minus Marks</option>
                              <option value="-1">-1</option>
                              <option value="-2">-2</option>
                              <option value="-3">-3</option>
                              <option value="-4">-4</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-12 text-center">
                          <i class="fa fa-spinner fa-spin" id="loader"></i>
                          <button type="submit" name="submit" class="btn btn-dark waves-effect waves-light">SAVE RECORD</button>
                        </div>
                        <div class="col-lg-12">
                          <br>
                          <div class="form-group">
                            <div class="alert alert-danger" role="alert" id="invexam"><strong>Error! Select exam</strong></div>
                            <div class="alert alert-danger" role="alert" id="invfile"><strong>Error! Invalid file format</strong></div>
                            <div class="alert alert-danger" role="alert" id="invans"><strong>Error! Select answer</strong></div>
                            <div class="alert alert-danger" role="alert" id="invplus"><strong>Error! Select plus marks</strong></div>
                            <div class="alert alert-danger" role="alert" id="invalid"><strong>Error! Some error occurs unable to save record</strong></div>
                            <div class="alert alert-danger" role="alert" id="fail"><strong>Error! Unable to proceed your request</strong></div>
                            <div class="alert alert-success" role="alert" id="success"><strong>Success! Save record</strong></div>
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
    <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/pages/form-advanced.js"></script>
    <script src="mcq-js/que-ans.js"></script>
  </body>
</html>