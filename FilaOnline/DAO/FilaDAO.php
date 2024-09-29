<?php

interface FilaDAO {  

    public function createFila($fila);
    function updateFila($fila);
    function getFila($idFila);
    function getAllFilas($idEstabelecimento);
    function deleteFila($idFila);
    function getFilaUsuario($idFila);
    function getFilaId($idFila);
    
    function entrarFila($userId, $filaId);
}
