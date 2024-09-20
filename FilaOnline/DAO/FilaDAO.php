<?php

interface FilaDAO {  

    public function createFila($idEstabelecimento, $nome, $endereco, $inicio, $termino);
    function updateFila($idFila, $nome, $endereco, $img);
    function getFila($idFila);
    function getAllFilas($idEstabelecimento);
    function deleteFila($idFila);
    function getFilaUsuario($idFila);
}

