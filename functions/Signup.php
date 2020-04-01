<?php 
    // Hint!! When requireing files, I suggest using absolute file paths as this method tends to break things...
    require_once('./functions/Db.php');

    /**
     * @param Array $data
     * @return Array 
     * @desc Receives an array conaining our user information in an attempt to create a new user.
    */

    function Signup(array $data) 
    {
        $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        //Registration Data Filtering....
        $first_name = stripcslashes(strip_tags($Data['first_name']));
        $last_name = stripcslashes(strip_tags($Data['last_name']));
        $email = stripcslashes(strip_tags($Data['email']));
        $password = htmlspecialchars($Data['password']);
        //Just In Case....
        $Errors = [];

        if (is_numeric($first_name)) {
            $Errors['first_name'] = "Sorry, Please enter a valid first name";
        }

        if (is_numeric($last_name)) {
            $Errors['last_name'] = "Sorry, Please enter a valid last name";
        }

        //Check if the email exists...
        $emailExists = checkEmail($email);
        if ($emailExists['status']) {
            $Errors['email'] = "Sorry, This email address has been taken.";
        }

        if (strlen($password) < 7) {
            $Errors['password'] = "Please, Use a password with a a length greater than 7.";
        }

        if (count($Errors) > 0) {            
            return $Errors;
        } else {
            //Create the new user...
            $Data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $password
            ];
            $registration = register($Data);
            
            if ($registration) {
                //Before the redirect this would be a good time to send a mail or something in order to verify the user...
                $_SESSION['user'] = $Data;
                header("Location: dashboard.php");
            } else {
                //#You could probably notify the dev team within this line but this is just a demo still....
                $Errors['error'] = "Sorry an unexpected error and your account could not be created. Please try again later.";
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
        $statement = $dbHandler->prepare("SELECT * FROM `user` WHERE `email` = :email");
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

    /**
     * @param Array $data
     * @return Array 
     * @desc Creates a new user and returns a boolean indicating the status of the              operation...
     */
    function register(array $data)
    {
        $dbHandler = DbHandler();
        $statement = $dbHandler->prepare("INSERT INTO `user` (first_name, last_name, email, password, status, created_at, updated_at) VALUES (:first_name, :last_name, :email, :password, :status, :created_at, :updated_at)");
        
        //#Defaults....
        $timestamps = date('Y-m-d H:i:s');
        $status = 1;
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        //Values Bindings....
        $statement->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
        $statement->bindValue(':last_name', $data['last_name'], PDO::PARAM_STR);
        $statement->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->bindValue(':status', $status, PDO::PARAM_INT);
        $statement->bindValue(':created_at', $timestamps, PDO::PARAM_STR);
        $statement->bindValue(':updated_at', $timestamps, PDO::PARAM_STR);
        
        $result = $statement->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
?>