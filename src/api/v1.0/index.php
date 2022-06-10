<?php

require_once '../includes/PeticionREST.inc';

$peticion = new PeticionREST('v1.0');

$salida = [];

require "modelos/" . $peticion->recurso() . ".php";

header('Content-Type: application/json; charset=utf-8');
echo json_encode($salida);