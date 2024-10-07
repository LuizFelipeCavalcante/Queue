<?php

interface FilaDAO {  

    public function createFila($fila);
    function updateFila($fila);
    function getFila($idFila);
    function getAllFilas();
    function getAllFilasPorEstabelecimento($idEstabelecimento);
    function deleteFila($idFila);
    function getFilaUsuario($idEstabelecimento);
    function getFilaId($idFila);
    
    function entrarFila($userId, $filaId);
}
