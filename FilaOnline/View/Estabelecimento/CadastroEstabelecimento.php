<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Codigo Fila</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="css/CadastroEstabelecimento.css">
<script src="js/Cadastro.js" type="text/javascript" defer></script>
<style>
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    overflow-x: hidden;
    background-color: white;
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

.big-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 150vh;
}
.signup-container {
	text-align: center;
}
.signup-box {
    width: 400px;
    background-color: #ffffff;
    color: #808080;
    padding: 30px;
    padding-bottom: 40px;
    padding-top: 40px;
    border-radius: 20px;
    box-shadow: 0 0 10px #2e9fea;
    text-align: center;
}

    .signup-box h2 {
        margin-bottom: 20px;
    }

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 20px;
    }

    .btnsenha{
        width: 10%;
    }

.btn-entrar {
    width: 100%;
    padding: 10px;
    background-color: #66b1e3;
    color: #ffffff;
    border: none;
    border-radius: 20px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

    .btn-entrar:hover {
        background-color: #4fa7e2;
    }

.bottom-text {
    margin-top: 20px;
}

    .bottom-text p {
        color: #66b1e3;
        font-size: 0.9rem;
    }

    .bottom-text a {
        color: #808080;
        text-decoration: underline;
        transition: color 0.3s ease;
    }

        .bottom-text a:hover {
            color: #9a9a9a;
        }

/* Estilo para o botão */
.btnsenha {
    border: none;
    background: transparent;
    cursor: pointer;
}

/* Estilo para SVGs */
svg {
    display: inline-block;
}
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
/* media tela de signup para celulares */
@media (max-width: 400px) {
    .signup-box {
        width: 90%;
        padding: 20px;
    }

    .btn-entrar {
        font-size: 0.9rem;
        padding: 8px;
    }
}

.big-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* changed from 150vh to 100vh */
    margin: 0 auto; /* added to center horizontally */
}
    </style>
</head>

<body>
<?php
    include "../Layout/HeaderEstabelecimento.php"
?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<div class="big-container">
	<div class="signup-container">
        
	    <div class="signup-box">
		
	        <h2>Cadastro Estabelecimento</h2>
	        <form action="../../Controller/EstabelecimentoController?action=create_conta" method="post">
	            <div class="form-group">
                <label for="nome">Nome:</label>
                <input  type="text" id="nome" name="nome" required>
	            </div>
	            <div class="form-group">

				<label for="email">Email:</label>
                <input  type="email" id="email" name="email" required>
	            </div>
	            <div class="form-group">
            

				<label for="cnpj">CNPJ:</label>
                <input  type="text" id="cnpj" name="cnpj" required>
	            </div>
	            <div class="form-group">

				<label for="endereco">Endereço:</label>
                <input  type="text" id="endereco" name="endereco" required>
	            </div>
	            <div class="form-group">

				<label for="endereco">Descricao:</label>
                <input  type="text" id="descricao" name="descricao" required>
	            </div>
	            <div class="form-group">

				<label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
	            <button type="button" class="btnsenha" name="btnsenha" onclick="togglePass()" id="btnsenha"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg></button>
                </div>
	            <a href="/"><button class="btn-entrar" type="submit">Cadastrar</button></a>
				<div class="bottom-text">
	            <p>Já possui conta? <a href="LoginEstabelecimento">Faça login aqui!</a></p>
	        </div>
	        </form>
	    </div>
	</div>
</div>
</body>


</html>