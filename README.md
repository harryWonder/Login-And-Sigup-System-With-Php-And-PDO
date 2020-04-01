#Login And Signup System Using **PHP AND PDO (PROCEDURAL)**

This project is a simple example of how to authenticate and create users using **PHP AND PDO (PHP DATA OBJECTS)**. You can visit the [php.net website](https://www.php.net/pdo) to learn more about how **PDO** works. You can also view a working demo of this project at [Login & Signup With Php PDO (Procedural)](https://www.herokuapp.com). I have also written a Blog about this topic on [Codelighters](https://www.codelighters.com) where I took my time to explain different methods about the PHP DATA OBJECTS. Don't forget to follow me and upvote my work.

#Folder Structure

 The following files acts as our view files and they all exist in our project root directory.

 * login.php
 * dashboard.php
 * register.php

 These files contains the html structure (Form Included) for achieving this simple process. At the very top of these files are some php logic which handles some simple operations when a form is submitted.

 There is also a **functions folder** in our project directory which contains all the Business logic needed to make our forms work. In our functions folder, we have the following;

 1. **DB.PHP**
    This file houses a function which is responsible for creating a __DB Connection__ which infact is a **PDO Instance** or a **PDO Object** which we can then now use within our application in performing **CRUD (Create, Read, Update Delete)** operations.

    ```php
            session_start();

            /**
             * @param void | null
             * @return array | mixed
             * @desc THis function creates a new PDO connection and returns the       handler.
            **/

            function DbHandler ()
            {
                $dbHost = 'localhost';
                $dbName = 'YOUR_DATABASE_NAME';
                $dbUser = 'YOUR_MYSQL_USERNAME';
                $dbPass = 'YOUR_MYSQL_PASSWORD';
                //Create a DSN for the database resource...
                $Dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
                //Create an options configuration for the PDO connection...
                $options = array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );

                try {
                    $Connection = new PDO($Dsn, $dbUser, $dbPass, $options);
                    return $Connection;
                } catch (Exception $e) {
                    return 'Couldn\'t Establish A Database Connection. Due to the following reason: ' . $e->getMessage();
                }
            }
    ```
2. **LOGIN.PHP**
    This file makes use of our __DB.PHP__ file which makes the **DBHandler function** available to us which we can then now make use of in communicating with our **MYSQL DATABASE** in order to verify the users __Email Address__ and __Password__. 
    The file has two functions,
    
    1. **Login** 
        This is where our business logic for authenticating a user is processed. The function returns an **Array** if the user fails validation and performs a redirect if the validation is passed. 
        
        The __Superglobals $_POST__ is filtered and the values from the associative array is stripped off of any html special characters as this helps in preventing __Sql Injection__. After this, we check if the Email exists by calling the **checkEmail function** with the user's Email address as it's arguement which then returns an **Errors Array** if the Email address is not found but returns an Array containing the Users Information if the user exists. 
        
        The __password, an (hash)__ from the returned Array is then matched against the users typed in password using php's **password_verify** function. which returns a Boolean if the given password matches the hash. You can find more information on the [php.net website](https://www.php.net/password_verify) on using the __password_verify function__. 

        The boolean returned from the function __password_verify__ is then used in our conditional which sets a user session and redirects our user if true or returns an Errors Array if false.

        ```php

            /**
             * @param Array $data
             * @return Array | void
             * @desc Receives an email address and password from the $_POST superglobal and matches it against the databse      records to authenticate the user
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
        ```
    2. **checkEmail**
        This functions gets the users email address and queries our database by using our **DBHandler Function** using **PDO (PHP DATA OBJECTS)** __prepared statements__ to achieve this which is more secure than passing in the values directly which makes any application vulnerable to __MYSQL INJECTION__.
        
        ```php
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
        ```
3. **SIGNUP.PHP**
    This file also makes use of our **DBHandler function** in communicating with our **MYSQL DATABASE** to perform **CRUD (Create, Read, Update Delete)** operations. The file also houses 3 functions which helps us with the process of creating a new user. 
    
    In our **SIGNUP.PHP** we have the __Signup function__ which handles our Business logic for creating a new user. The __Signup function__ accepts an Array as it's arguement and returns an Errors array if a condition is not satisfied else it performs an HTTP Redirect. We also filter and strip the values from our __$_POST Superglobals__ which helps us in preventing __Sql Injection__.

    We have some simple conditions such as; 
    * checking if an email exists
    * checking if the first name is a string
    * checking if the last name is a string
    * verifying that the password is greater than 7 characters.

    When all conditions are satisfied, we call the __register function__ which creates a new user by using our __DBHandler function__, set a new session for the user and perform an HTTP Redirect.
    ```php
        
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

I have also attached the mysql file needed for you to set up this application and have it up and running. Once again, don't forget to read my Blog on [Codelighters](https://www.codelighters.com), follow me, and upvote my work. With love, Ilori Stephen A . :metal: