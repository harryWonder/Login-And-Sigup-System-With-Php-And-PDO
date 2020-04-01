<?php
  require_once('./functions/Db.php');
  
  /**
   * @param Array $data
   * @return Array | void
   * @desc Receives an email address and password from the $_POST superglobal and matches it against the databse records to     authenticate the user
   */

  function Login(array $data)
  {
    $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $Errors = [];

    $Email = stripcslashes(strip_tags($Data['email']));
    $Password = stripcslashes(strip_tags($Data['password']));

    //check if the email address exists in the database...
    $Email_check = checkEmail($Email);
    if (!$Email_check['status']) {
      $Errors['general'] = "Invalid credentials passed. Please, check the Email or Password and try again.";
      return $Errors;
    } else {
      //we check that the password matches the hash
      if (password_verify($Password, $Email_check['data']['password'])) {
        //Do a redirect... You can also make some modifications to the database by calling some files before we proceed... A use case would be changing the time the user last logged in!!
        header("Location: dashboard.php");
      } else {
        $Errors['general'] = "Invalid credentials passed. Please, check the Email or Password and try again.";
        return $Errors;
      }
    }
  }

  /**
     * @param String $email
     * @return Array 
     * @desc Checks if an email string exists in the database and returns   an array which determines the output of the operation.
  */
  
  function checkEmail(string $email) : array
  {
    $dbHandler = DbHandler();
    $statement = $dbHandler->prepare("SELECT `first_name`, `last_name`, `email`, `password` FROM `user` WHERE `email` = :email");
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $response['status'] = false;
        $response['data'] = [];
        return $response;
    }

    $response['status'] = true;
    $response['data'] = $result;
    return $response;
  }
?>
