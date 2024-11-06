<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Codigo Fila</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>

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
            .container {
  background-color: #fff;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  text-align: center;
  /* Ajuste a posição do container */
  margin-top: 20px;
}
        </style>
    </head>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Codigo Fila</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/Estabelecimentos.css">
    </head>

    <body>
        <?php include "../Layout/HeaderUsuario.php"; ?>

        <div class="page">
            <main class="container">
                <div class="row justify-content-center">
                    <?php if (!empty($_SESSION['estabelecimentos'])): ?>
                        <?php foreach (array_reverse($_SESSION['estabelecimentos']) as $estabelecimento): ?>
                            <div class="col-6 col-sm-4 col-md-3 mb-4"> <!-- Aqui ajustamos as classes -->
                                <a href="../../Controller/EstabelecimentoController?action=readfila_estabelecimento&id=<?php echo htmlspecialchars($estabelecimento['id']); ?>"
                                    class="btn btn-primary">
                                    <div class="card">

                                        <?php if (isset($estabelecimento['img'])): ?>
                                            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($estabelecimento['img']); ?>"
                                                class="card-img-top" alt="Fila 1">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Fila 1">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($estabelecimento['name']); ?>
                                            </h5>
                                            <p class="btn btn-primary">Entrar na Fila</p>
                                        </div>
                                    </div>
                            </div></a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhum estabelecimento encontrado</p>
                    <?php endif; ?>
                </div>
            </main>
            <br>
        </div>

        <!-- jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>