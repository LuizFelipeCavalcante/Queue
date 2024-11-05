<?php

interface FilaDAO
{

    public function createFila($fila);
    function updateFila($fila);
    function getFila($idFila);
    function getAllFilas();
    function getAllFilasPorEstabelecimento($idEstabelecimento);
    function deleteFila($idFila);
    function getFilaUsuario($idEstabelecimento);
    function getFilaId($idFila);
    function verificarFilaUsuario($userId);
    function entrarFila($userId, $filaId);
    function passarUsuario($filaId);
    function voltarUsuario($filaId);
    function contarPessoasFila($filaId);

}
