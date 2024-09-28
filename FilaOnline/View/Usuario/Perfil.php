<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deslogado</title>
        <style>
            /* Reset básico */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html, body {
                height: 100%;
                font-family: Arial, sans-serif;
                background-color: #3a0647;
                color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0;
            }

            .container {
                text-align: center;
                background-color: #fff;
                color: #333;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            .container h1 {
                font-size: 24px;
                margin-bottom: 20px;
                color: #3a0647;
            }

            .container a {
                color: #66b1e3;
                text-decoration: none;
                font-size: 16px;
                font-weight: bold;
                transition: color 0.3s ease;
            }

            .container a:hover {
                color: #4fa7e2;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Deslogado</h1>
            <p><a href="../index.php">Voltar para página inicial</a></p>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Perfil</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="css/Perfil.css">
<script src="js/Cadastro.js" type="text/javascript" defer></script>
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
            color: #2e9fea !important; /* Cor personalizada para os links */
            border: 1px solid #d3d3d3; /* Borda cinza claro */
            border-radius: 4px; /* Borda arredondada */
            padding: 8px 12px; /* Espaçamento interno */
            margin: 2px; /* Espaçamento entre os links */
            transition: background-color 0.3s, border-color 0.3s; /* Transição suave para o hover */
        }
        .navbar-nav .nav-link:hover {
            background-color: #e9f5fc; /* Cor de fundo ao passar o mouse */
            border-color: #2e9fea; /* Cor da borda ao passar o mouse */
            color: #2e9fea !important; /* Cor do texto ao passar o mouse */
        }
        .navbar-brand img {
            max-height: 50px; /* Ajuste a altura da imagem do logotipo */
        }
        .navbar {
            text-align: center; /* Centraliza o texto no header */
        }
        .navbar-collapse {
            justify-content: center; /* Centraliza o conteúdo da barra de navegação */
        }
    </style>
</head>
<body>
    <?php
        include "../Layout/HeaderUsuario.php"
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<main>
    <div class="profile-container">
        <div class="profile-card">
        <form class="form-horizontal" action="../Controller/ContaController?action=update_img" method="post" enctype="multipart/form-data">
            <div class="profile-img-container">
                <img class="profile-img" src="<?php echo $_SESSION['foto']; ?>" alt="Foto do perfil" />
                <h3 class="profile-username"><?php echo $_SESSION['user_name']; ?></h3>

            </div>
        </form>
            <form class="form-horizontal" action="../../Controller/ContaController?action=update_conta" method="post" enctype="multipart/form-data">
                <label class="btn btn-primary btn-block">
                    Trocar foto de perfil
                    <input type="file" name="profile_img" accept="image/*" style="display: none;">
                </label>    
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $_SESSION['user_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo $_SESSION['telefone']; ?>" maxlength="15">
                </div> <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>                </div>
                
                <button type="submit" class="btn btn-danger">Salvar alterações</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
