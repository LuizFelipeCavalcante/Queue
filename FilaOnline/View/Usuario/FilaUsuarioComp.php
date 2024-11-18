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

<body>
   

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    console.log('jQuery version:', $.fn.jquery); // Deve exibir a versão do jQuery no console
</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div id="fila">
    
    <div class="container" >
        <div class="logo">
            <img src="../../img/logo01.png" alt="Logo do Site">
            <p class="text-muted">Você está na fila <?php echo htmlspecialchars($_SESSION['filasuser'][0]['nome']) ?>
            </p>

        </div>
        <div class="fila" >
            <?php

            $primeirapessoa = 1;

            if (!empty($_SESSION['filasuser'])):
                $filaPaia = false; // Isso é só para ver se tem algum usuário na fila ou não;
                foreach (array_reverse($_SESSION['filasuser']) as $filau):

                    if ($primeirapessoa == count($_SESSION['filasuser'])) {
                        $pessoaematendimento = htmlspecialchars($filau['idUsuario']);
                    } else {
                        $primeirapessoa++;
                    }
                    ;

                    ?>
                    <div class="fila-item">
                        <?php if ($filau['idUsuario'] != null) {
                            if (!isset($pessoaematendimento)) {
                                echo htmlspecialchars($filau['idUsuario']);
                            } 
                            ;
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
        <div class="pessoa-atendida">
            Pessoa sendo atendida <br> <span> <?php echo($pessoaematendimento);?></span>
        </div>

        <div class="info">
        <?php 
            $colunaUsuarios = array_column($_SESSION['filasuser'], 'idUsuario');

            // Busca o índice na coluna onde o idUsuario coincide com o valor buscado
            $posicao = array_search($_SESSION['user_id'], $colunaUsuarios);

              ?>
            <div>
                    <p><strong>Tempo para atendimento</strong></p>
                    <p><?php echo htmlspecialchars( round($_SESSION['filasuser'][0]['tempoMedio'] * ($posicao + 1)))?> minutos</p>
    
                </div>
            <div>
                <p><strong>Lugar na fila</strong></p>
                <p> <?php if ($posicao !== null) {
                    echo $posicao + 1;
                    unset($posicao);
                } ?> º lugar</p>
            </div>
        </div>
        <div>Endereço do Local: <br> <?php echo htmlspecialchars($_SESSION['filasuser'][0]['endereco']) ?></div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
