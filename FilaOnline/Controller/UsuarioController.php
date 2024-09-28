<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once(__DIR__ . '/../Model/Usuario.php');
include_once(__DIR__ . '/../DAO/UsuarioDAOImpl.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';
