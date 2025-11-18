<?php 
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['loginUser']) && $_SESSION['senhaUser'] === true) {
    header("Location: paginas/home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seu Gerenciador de Filmes Favoritos | Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #1c1b47, #0a1a33);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }

    .login-container {
      width: 100%;
      max-width: 450px;
      text-align: center;
    }

    .login-card {
      background: #141424;
      border-radius: 15px;
      padding: 2rem;
      margin-top: 20px;
      box-shadow: 0 10px 35px rgba(0,0,0,0.6);
      animation: fadeIn 0.5s ease;
      color: #ddd;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .cinema-img {
      width: 120px;
      margin-bottom: 15px;
      filter: drop-shadow(0 3px 8px rgba(0,0,0,0.7));
    }

    h1 {
      color: #ffffff;
      text-shadow: 0 2px 6px rgba(0,0,0,0.6);
    }

    label {
      font-weight: 600;
      margin-bottom: 5px;
      text-align: left;
      width: 100%;
      color: #e4e4e4;
    }

    .form-control {
      height: 48px;
      border-radius: 8px;
      background: #1f1f35;
      border: 1px solid #3a3a5a;
      color: #fff;
    }

    .form-control::placeholder {
      color: #b5b5d0;
    }

    .btn-primary {
      background-color: #233b8e;
      border: none;
      font-size: 1.1rem;
      padding: 10px;
      border-radius: 8px;
      margin-top: 10px;
    }

    .btn-primary:hover {
      background-color: #152663;
    }

    a {
      color: #4d6dff;
      text-decoration: none;
    }

    a:hover { text-decoration: underline; }
  </style>
</head>
<body>

<div class="login-container">

  <!-- IMAGEM DE CINEMA -->
  <img src="https://cdn-icons-png.flaticon.com/512/2798/2798007.png" class="cinema-img" alt="Cinema">

  <h1 class="mt-1 fw-bold">Bem-vindo ao Catálogo de Filmes</h1>
  <p class="mt-1" style="color:#d6d6d6;">Gerencie e organize seus filmes favoritos facilmente</p>

  <div class="login-card">

    <?php
    include_once('config/conexao.php');

    if (isset($_GET['acao'])) {
        if ($_GET['acao'] == 'negado') {
            echo '<div class="alert alert-danger text-center">Erro ao acessar o sistema! Efetue o login.</div>';
        } elseif ($_GET['acao'] == 'sair') {
            echo '<div class="alert alert-warning text-center">Você saiu do sistema!</div>';
        }
    }

    if (isset($_POST['login'])) {
        $login = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

        if ($login && $senha) {
            $select = "SELECT * FROM tb_user WHERE email_user = :emailLogin";

            try {
                $resultLogin = $conect->prepare($select);
                $resultLogin->bindParam(':emailLogin', $login, PDO::PARAM_STR);
                $resultLogin->execute();

                if ($resultLogin->rowCount() > 0) {
                    $user = $resultLogin->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($senha, $user['senha_user'])) {
                        $_SESSION['loginUser'] = $login;
                        $_SESSION['senhaUser'] = $user['id_user'];
                        echo '<div class="alert alert-success text-center">Logado com sucesso! Redirecionando...</div>';
                        header("Refresh: 2; url=paginas/home.php?acao=bemvindo");
                    } else {
                        echo '<div class="alert alert-danger text-center">Senha incorreta!</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger text-center">E-mail não encontrado!</div>';
                }

            } catch (PDOException $e) {
                echo '<div class="alert alert-danger text-center">Erro ao tentar logar. Tente mais tarde.</div>';
            }

        } else {
            echo '<div class="alert alert-danger text-center">Todos os campos são obrigatórios.</div>';
        }
    }
    ?>

    <p class="text-center mb-4" style="color:#b8b8c7; font-size:0.95rem;">
      Para acessar, é necessário um e-mail e senha válidos.
    </p>

    <form method="post" class="mt-2">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" class="form-control mb-3" placeholder="seuemail@gmail.com" required>

      <label for="senha">Senha</label>
      <input type="password" id="senha" name="senha" class="form-control mb-3" placeholder="Sua senha" required>

      <button type="submit" name="login" class="btn btn-primary w-100">
        <i class="fa-solid fa-right-to-bracket"></i> Acessar os Filmes
      </button>

    </form>

    <p class="text-center mt-3">
      <a href="cad_user.php">Ainda não tem cadastro? Clique aqui!</a>
    </p>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
