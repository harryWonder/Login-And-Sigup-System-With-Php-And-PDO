<?php
  require_once('./functions/Signup.php');
  if (isset($_POST) && count($_POST) > 0) {
        $Response = Signup($_POST);
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
                        <h5 class="card-title">Signup</h5>
                        <?php if (isset($Errors) && count($Errors) > 0): ?>
                            <!-- Bootstrap Alert -->
                        <?php endif; ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12 col-xl-12">
                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <input type="text" name="first_name" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12 col-xl-12">
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12 col-xl-12">
                                    <div class="form-group">
                                        <label for="">Email</label>
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
                                        <button type="submit" class="btn btn-success btn-block">Register</button>
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
