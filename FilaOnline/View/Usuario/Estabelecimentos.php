<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();

    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Codigo Fila</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Estabelecimentos.css">
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
        </style>
    </head>

    <body>
        <?php
        include "../Layout/HeaderUsuario.php"
            ?>

        <!-- jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <div class="page">

            <main class="container">
                <div class="row justify-content-center">

                    <?php if (!empty($estabelecimentos)): ?>
                        <?php foreach (array_reverse($estabelecimentos) as $fila): ?>

                            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                                <div class="card" style="width: 15rem; border-radius: 20px; padding: 10px; margin-bottom: 30px">
                                    <img src="../../Img/mcdonalds.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($fila['name']); ?></h5>

                                        <a href="/PaginaFila/1" class="btn btn-primary">Entrar na Fila</a>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhum estabelecimento encontrado</p>
                    <?php endif; ?>

            </main>
            <br>
        </div>
    </body>

</html>