<?php
class UserController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }

                $arrUsers = $userModel->getAllUsers($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    /**
     * "/user/login" Endopoint - Verify login
     */
    public function loginAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        //$arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();

                // Check if username is empty
                if (empty(trim($_POST["email"]))) {
                    $strErrorDesc = "Please enter a username.";
                    $strErrorHeader = "HTTP/1.1 401 Unauthorized";
                } else {
                    $username = trim($_POST["email"]);
                }

                // Check if password is empty
                if (empty(trim($_POST["password"]))) {
                    if ($strErrorDesc) {
                        $strErrorDesc = "Please enter your username and password.";
                    } else {
                        $strErrorDesc = "Please enter your password.";
                    }
                    $strErrorHeader = "HTTP/1.1 401 Unauthorized";
                } else {
                    $password = trim($_POST["password"]);
                }

                //Validate credentials
                if (!$strErrorDesc) {
                    $param_username = $username;
                    $arrUsers = $userModel->getUser($param_username);
                    $id = $ussername = $passwordValidation = "";
                    
                    //var_dump($arrUsers);
                    // Check if username exists, if yes then verify password

                    $arrlenght = count($arrUsers);
                    if ($arrlenght == 1) {
                        foreach ($arrUsers as $number => $array) {
                            foreach ($array as $key => $value) {
                                switch ($key) {
                                    case 'password':
                                        if ($password == $value) {
                                            $passwordValidation = true;
                                            /*
                                            if (password_verify($password, $value)) {
                                                echo "He entrado";
                                            }
                                            */
                                        } else {
                                            $strErrorDesc = "Incorrect password";
                                            $strErrorHeader = "HTTP/1.1 401 Unauthorized";
                                        }
                                        break;
                                    case 'id':
                                        $id = $value;
                                        break;
                                    case 'nombre':
                                        $ussername = $value;
                                        break;
                                    case 'rol':
                                        $rol = $value;
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }
                        $responseData = '{"loggedin":"' . $passwordValidation . '","id":"' . $id . '","username":"' . $ussername . '","rol":"' . $rol . '"}';
                    } else {
                        $strErrorDesc = "Incorrect username";
                        $strErrorHeader = "HTTP/1.1 401 Unauthorized";
                    }
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
