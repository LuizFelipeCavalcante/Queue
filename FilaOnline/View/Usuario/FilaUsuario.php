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

        .navbar-nav .nav-link {
            color: #2e9fea !important;
            border: 1px solid #d3d3d3;
            border-radius: 30px;
            padding: 8px 20px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }
        

        .navbar-nav .nav-link:hover {
            background-color: #e9f5fc;
            border-color: #2e9fea;
            color: #2e9fea !important;
        }

        .navbar-brand img {
            max-height: 50px;
        }

        .container {
            background-color: #fff;
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
    <?php


include_once "../Layout/HeaderUsuario.php";


    ?>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    console.log('jQuery version:', $.fn.jquery); // Deve exibir a versão do jQuery no console
</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div id="fila">
<?php include 'FilaUsuarioComp.php' ?>
</div>
</body>
</html>
<script>
const id = <?php echo htmlspecialchars($_SESSION['user_id']); ?>;
document.addEventListener("DOMContentLoaded", function() {
    setInterval(function() {
        fetch(`../../Controller/FilaController.php?action=readfila_usuariocomp&id=${id}`)
            .then(response => response.text())
            .then(data => {
                const filaElement = document.getElementById('fila');
                if (filaElement) {  // Verifica se o elemento existe
                    filaElement.innerHTML = data;
                } else {
                    console.error('Elemento #fila não encontrado');
                }
            })
            .catch(error => console.error('Erro ao atualizar a fila:', error));
    }, 5000);  // Atualiza a cada 5 segundos
});</script>