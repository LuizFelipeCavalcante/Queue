<head>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            color: #2e9fea !important
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
            margin-top: 10%;
        }

        .fila {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .fila-item {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .logo {
            margin-bottom: 20px;
        }

        .pessoa-atendida {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0062cc;
        }
    </style>
</head>

<body>
    <?php
    include "../Layout/HeaderEstabelecimento.php";

    ?>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <div class="container">
        <div class="logo">
            <img src="../../img/logo01.png" alt="Logo do Site" width="150">
        </div>
        <div class="fila">
            <?php // Essa sessao é do capeta, ela existe ate quando eu n crio ela 
            // fiz uma gambiarra pra resolver😂
            if (!empty($_SESSION['filaatual'])):
                $filaPaia = false; //isso é so pra ver se tem algum usuario na fila ou não;
                foreach (array_reverse($_SESSION['filaatual']) as $filau): ?>

                    <div class="fila-item"><?php if ($filau['idUsuario'] != null) {
                        echo htmlspecialchars($filau['idUsuario']);
                    } else {
                        echo "<p>Nenhuma pessoa na fila.</p>";
                        $filaPaia = true;
                        break;
                    }
                    ?></div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma pessoa na fila.</p>
            <?php endif; ?>
        </div>
        <?php if ($filaPaia == null): ?>
            <div class="pessoa-atendida">Pessoa sendo atendida</div>
            <a href=""><button class="btn">Voltar</button></a>
            <a
            href="..\..\Controller\FilaController.php?action=proxima_pessoa&id=<?php $objeto = $_SESSION['filaatual'];
            $id = $_SESSION['filaatual'][0]['id'];
            echo ($id) ?>"><button
            class="btn">Próximo</button></a>
        <?php endif; ?>
    </div>

    <?php
    include '../../QrCode/qrcode.php';




    if (isset($_POST['qr'])) {
        $text = $_POST['qr'];
        $name = md5(time()) . ".png";
        $file = "Files/{$name}";
        $options = array(
            'w' => 500,
            'h' => 500,
        );
        $generator = new QRCode($text, $options);
        $generator->output_image();
    }
    ?>

    <form action="" method="POST">
        <input type="text" name="qr" placeholder="Texto">
        <button type="submit">Gerar</button>
    </form>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>