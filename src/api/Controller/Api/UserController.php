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

                $arrUsers = $userModel->getAllUsers();
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
     * "/user/list" Endpoint - Get list of users
     */
    public function getAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                if (isset($arrQueryStringParams['email']) && $arrQueryStringParams['email']) {
                    $email = $arrQueryStringParams['email'];
                } else {
                    $strErrorDesc = 'Introduzca el email del usuario que se va a obtener';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }

                $arrUsers = $userModel->getUser($email);
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
     * "/user/insert" Endopoint - Insert user 
     */
    public function insertAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();

                if (!empty(trim($_POST["email"])) && !empty(trim($_POST["nombre"])) && !empty(trim($_POST["pass"])) && !empty(trim($_POST["empresa"])) && !empty(trim($_POST["rol"]))) {
                    $email = trim($_POST["email"]);
                    try {
                        $arrUsers = $userModel->getUser($email);
                        $arrlenght = count($arrUsers);
                        if ($arrlenght == 1) {
                            $strErrorDesc = "There is already a user with this email.";
                            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                        }
                    } catch (Error $e) {
                        $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    }
                    $nombre = trim($_POST["nombre"]);
                    $empresa = trim($_POST["empresa"]);
                    $pass = trim($_POST["pass"]);
                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                    $rol = trim($_POST["rol"]);
                } else {
                    $strErrorDesc = "Please complete all fields.";
                    $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
                }

                if (!$strErrorDesc) {
                    $insertComplete = $userModel->insertUser($email, $nombre, $empresa, $pass, $rol);
                    $responseData = json_encode($insertComplete);
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

    /**
     * "/user/delete" Endpoint - Delete user
     */
    public function deleteAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                if (isset($arrQueryStringParams['email']) && $arrQueryStringParams['email']) {
                    $email = $arrQueryStringParams['email'];
                } else {
                    $strErrorDesc = 'Introduzca el email del usuario que se va a borrar';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }

                $deleteComplete = $userModel->deleteUser($email);
                $responseData = json_encode($deleteComplete);
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
     * "/user/edit" Endopoint - Edit user 
     */
    public function editAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();

                if (!empty(trim($_POST["email_old"])) && !empty(trim($_POST["email"])) && !empty(trim($_POST["nombre"]))  && !empty(trim($_POST["empresa"])) && !empty(trim($_POST["rol"]))) {
                    $email_old = trim($_POST["email_old"]);
                    $email = trim($_POST["email"]);
                    $nombre = trim($_POST["nombre"]);
                    $empresa = trim($_POST["empresa"]);
                    $rol = trim($_POST["rol"]);

                    try {
                        $arrUsers = $userModel->getUser($email_old);

                        foreach ($arrUsers as $usser) {
                            foreach ($usser as $key => $value) {
                                if ($key == "id") {
                                    $id = $value;
                                }
                                if ($key == "password") {
                                    if (!empty(trim($_POST["pass"]))) {

                                        $pass = trim($_POST["pass"]);
                                        $pass = password_hash($pass, PASSWORD_DEFAULT);
                                    } else {
                                        $pass = $value;
                                    }
                                }
                            }
                        }
                    } catch (Error $e) {
                        $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    }
                } else {
                    $strErrorDesc = "Please complete all fields.";
                    $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
                }

                if (!$strErrorDesc) {
                    $editComplete = $userModel->editUser($email, $nombre, $empresa, $pass, $rol, $id);
                    $responseData = json_encode($editComplete);
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

    /**
     * "/user/buscar" Endpoint - Buscar user
     */
    public function buscarAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                if (isset($arrQueryStringParams['param']) && $arrQueryStringParams['param']) {
                    $param = $arrQueryStringParams['param'];
                    $param = "%" . $param . "%";
                } else {
                    $strErrorDesc = 'Introduzca el email del usuario que se va a borrar';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }

                $buscar = $userModel->buscarUser($param);
                $responseData = json_encode($buscar);
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
