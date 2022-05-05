<?php
class ParcelaController extends BaseController
{
    /**
     * "/parcela/list" Endpoint - Get list of parcelas
     */

    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $parcelaModel = new ParcelaModel();

                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }

                $arrParcelas = $parcelaModel->getAllParcelas($intLimit);
                $responseData = json_encode($arrParcelas);
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

    public function userAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        //var_dump($arrQueryStringParams);
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $parcelaModel = new ParcelaModel();

                //$intUser = 1;
                if (isset($arrQueryStringParams['usuario']) && $arrQueryStringParams['usuario']) {
                    $intUser = $arrQueryStringParams['usuario'];
                }

                $arrParcelas = $parcelaModel->getUserParcelas($intUser);
                $responseData = json_encode($arrParcelas);
                //var_dump($responseData);
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
    public function verticesAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        //var_dump($arrQueryStringParams);
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $parcelaModel = new ParcelaModel();

                //$intUser = 1;
                if (isset($arrQueryStringParams['parcela']) && $arrQueryStringParams['parcela']) {
                    $intParcela = $arrQueryStringParams['parcela'];
                }
                $arrParcelas = $parcelaModel->getVerticesParcelas($intParcela);
                $responseData = array();
                foreach ($arrParcelas as $value) {
                    $value["lat"] = floatval($value["lat"]);
                    $value["lng"] = floatval($value["lng"]);
                    array_push($responseData, $value);
                }
                $responseData = json_encode($responseData);
                //var_dump($responseData);
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
    public function parcelaAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        //var_dump($arrQueryStringParams);
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $parcelaModel = new ParcelaModel();

                //$intUser = 1;
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $intUser = $arrQueryStringParams['id'];
                }

                $arrParcelas = $parcelaModel->getParcela($intUser);
                $responseData = json_encode($arrParcelas);
                //var_dump($responseData);
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
