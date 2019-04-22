	<?php   
  include_once('includes/DB_Functions.php');
  $db = new DB_Functions();
  error_reporting(0);
  if(!($_SESSION["user_id"])){
  header("Location:signout.php");
  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>New Batch</title>
    <!-- CSS -->
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
                  <h4 class="page-title">Create Batch</h4>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card m-b-20">
                  <div class="card-body">
                    <form class="m-t-12">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <div class="alert alert-danger" role="alert" id="invbatch"><strong>Error! Invalid batch name</strong></div>
                            <div class="alert alert-danger" role="alert" id="duplicate"><strong>Error! Batch name already exist</strong></div>
                            <div class="alert alert-danger" role="alert" id="invalid"><strong>Error! Some error occurs unable to save records</strong></div>
                            <div class="alert alert-danger" role="alert" id="fail"><strong>Error! Unable to proceed your request</strong></div>
                            <div class="alert alert-success" role="alert" id="success"><strong>Success! Record saved successfully</strong></div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter batch name" name="batch" id="batch" value="<?php echo $_POST['batch'];?>" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group text-center">
                            <i class="fa fa-spinner fa-spin" id="loader"></i>
                            <button type="submit" name="submit" class="btn btn-dark waves-effect waves-light">SAVE RECORD</button>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <div class="alert alert-success" role="alert" id="resultlist"><strong>Success! Records fetched successfully</strong></div>
                            <div class="alert alert-danger" role="alert" id="norecords"><strong>Error! No records to show</strong></div>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="row">
                      <div class="col-lg-12 m-b-10 text-right">
                        <button type="button" id="refresh" class="btn btn-primary waves-effect waves-light"><i class="fa fa-refresh"></i> REFRESH RECORDS</button>
                      </div>
                    </div>
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Batch Title</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="batchlist">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once('require/footer.php'); ?>
      </div>
    </div>
    <!-- jQuery  -->
    <?php require_once('require/footer-js.php'); ?>
    <script src="mcq-js/save-batch.js"></script>
  </body>
</html>