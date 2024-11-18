<head>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fila - Detalhes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fb;
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

        .logo img {
            width: 150px;
            margin-bottom: 20px;
        }

        .fila {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            color: #333;
        }

        .fila-item {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #333;
        }

        .pessoa-atendida {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 40px;
            color: rgb(6, 2, 84);
        }

        .pessoa-atendida span {
            font-weight: 400;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin: 10px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0062cc;
        }

        .info {
            margin-top: 30px;
            font-size: 18px;
            color: #555;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<div class="container">
    <div class="logo">
        <img src="../../img/logo01.png" alt="Logo do Site" width="150">
    </div>
    <div class="fila">
        <?php

        $primeirapessoa = 1;
        if (!empty($_SESSION['filaatual'])):
            $filaPaia = false; // Isso é só para ver se tem algum usuário na fila ou não;
            foreach (array_reverse($_SESSION['filaatual']) as $filau):

                if ($primeirapessoa == count($_SESSION['filaatual'])) {
                    echo ('<div class="pessoa-atendida">Pessoa sendo atendida</div>');
                } else {
                    $primeirapessoa++;
                }
                ;

                ?>
                <div class="fila-item">
                    <?php if ($filau['idUsuario'] != null) {
                        echo htmlspecialchars($filau['idUsuario']);
                    } else {
                        echo "<p>Nenhuma pessoa na fila.</p>";
                        $filaPaia = true;
                        break;
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma pessoa na fila.</p>
        <?php endif; ?>
    </div>

    <?php if ($filaPaia == null): ?>
        <a href="..\..\Controller\FilaController.php?action=voltar_pessoa&id=<?php $objeto = $_SESSION['filaatual'];
        $id = $_SESSION['filaatual'][0]['id'];
        echo ($id) ?>"><button class="btn">Voltar</button></a>
        <a href="..\..\Controller\FilaController.php?action=proxima_pessoa&id=<?php $objeto = $_SESSION['filaatual'];
        $id = $_SESSION['filaatual'][0]['id'];
        echo ($id) ?>"><button class="btn">Próximo</button></a>
    <?php endif; ?>
    </d>
</div>
<?php
$linkfila = $filau['id'];
?>
<a
    href="../../QrCode/Qr?link=http://localhost/Queue/FilaOnline/Controller/EstabelecimentoController?id=<?php echo $linkfila ?>"><button
        class="btn">Gerar qr code</button></a>

</body>