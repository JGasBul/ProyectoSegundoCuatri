<?php
class SondaController extends BaseController
{
    /**
     * "/sonda/list" Endpoint - Get list of Sondas
     */

    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $sondaModel = new SondaModel();

                $arrsondas = $sondaModel->getAllSondas();
                $responseData = json_encode($arrsondas);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
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
     * "/sonda/list" Endpoint - Get posiciones de las sondas
     */

    public function getMarcadoresAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $sondaModel = new SondaModel();

                if (isset($arrQueryStringParams['user']) && $arrQueryStringParams['user']) {
                    $intUser = $arrQueryStringParams['user'];
                } else {
                    $strErrorDesc = 'Introduzca la id del usuario';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }

                if (isset($arrQueryStringParams['parcela']) && $arrQueryStringParams['parcela']) {
                    $intParcela = $arrQueryStringParams['parcela'];
                } else {
                    if ($strErrorDesc) {
                        $strErrorDesc = 'Introduzca la id del usuario y de la parcela';
                    } else {
                        $strErrorDesc = 'Introduzca la id de la parcela';
                    }
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                if (!$strErrorDesc) {
                    $arrsondas = $sondaModel->getMarcadores($intUser, $intParcela);
                    $responseData = json_encode($arrsondas);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
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
     * "/sonda/list" Endpoint - Get mediciones de las sondas
     */
    public function getMedicionesAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $sondaModel = new SondaModel();

                if (isset($arrQueryStringParams['idSonda']) && $arrQueryStringParams['idSonda']) {
                    $intSonda = $arrQueryStringParams['idSonda'];
                } else {
                    $strErrorDesc = 'Introduzca la id de la sonda en cuestion';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }

                if (!$strErrorDesc) {
                    $arrmediciones = $sondaModel->getMediciones($intSonda);
                    $responseData = json_encode($arrmediciones);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
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
