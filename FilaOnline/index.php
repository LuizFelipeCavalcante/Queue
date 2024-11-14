<?php
namespace Home;
session_start();
unset($_SESSION["header"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Codigo Fila</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Navbar</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            .navbar-nav .nav-link {
                color: #2e9fea !important;
                /* Cor personalizada para os links */
                border: 1px solid #d3d3d3;
                /* Borda cinza claro */
                border-radius: 4px;
                /* Borda arredondada */
                padding: 8px 12px;
                /* Espaçamento interno */
                margin: 2px;
                /* Espaçamento entre os links */
                transition: background-color 0.3s, border-color 0.3s;
                /* Transição suave para o hover */
            }

            .navbar-nav .nav-link:hover {
                background-color: #e9f5fc;
                /* Cor de fundo ao passar o mouse */
                border-color: #2e9fea;
                /* Cor da borda ao passar o mouse */
                color: #2e9fea !important;
                /* Cor do texto ao passar o mouse */
            }

            .navbar-brand img {
                max-height: 50px;
                /* Ajuste a altura da imagem do logotipo */
            }

            .navbar {
                text-align: center;
                /* Centraliza o texto no header */
            }

            .navbar-collapse {
                justify-content: center;
                /* Centraliza o conteúdo da barra de navegação */
            }
        </style>
    </head>

                           
                    <?php

                    if (!isset($_SESSION['user_id'])) {
                        
                        header('Location: View/Usuario/Login.php');
                    } else {
                    if ($_SESSION['estabelecimento']) {
                        header('Location: Controller/EstabelecimentoController?action=readall_estabelecimento');
                        } else {
                            header('Location: View/Estabelecimento/HomeEstabelecimento.php');
                        }
                        }
                    
                    ?>
                
        Quero q o McDonalds se foda kkkkkk mo raiva dessa tela
    </body>

    </html>