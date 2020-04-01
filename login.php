<?php
  require_once('./functions/Login.php');
  if (isset($_POST) && count($_POST) > 0) {
     Login($_POST);
  }
?>
<!DOCTYPE html>
    <html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div class="container">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <?php if (isset($Errors) && count($Errors) > 0): ?>
                            <!-- Bootstrap Alert -->
                        <?php endif; ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12 col-xl-12">
                                    <div class="form-group">
                                        <label for="">Email Address</label>
                                        <input type="email" name="email" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>
        </div>
    </body>
</html>
