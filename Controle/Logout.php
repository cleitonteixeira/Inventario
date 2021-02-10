<?php

require_once '../vendor/autoload.php';

$u = new \Model\Usuario\UsuarioDao();

$u->Logout();

header("Location: ../index.php");