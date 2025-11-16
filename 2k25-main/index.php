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
  <title>catágolo de filmes | Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
      background: #ffffff;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }
    .login-card .form-control:focus {
      box-shadow: none;
      border-color: #2575fc;
    }
    .login-logo {
      font-size: 1.8rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 1.5rem;
      color: #2575fc;
    }
    .alert {
      margin-top: 1rem;
    }
    .login-card button {
      background-color: #2575fc;
      border: none;
    }
    .login-card button:hover {
      background-color: #6a11cb;
    }
  </style>
</head>
<body>

<div class="login-card">
  <div class="login-logo">
    catágolo de filmes
  </div>
  
  <?php
  include_once('config/conexao.php');

  // Mensagens de ação
  if (isset($_GET['acao'])) {
      $acao = $_GET['acao'];
      if ($acao == 'negado') {
          echo '<div class="alert alert-danger text-center">Erro ao acessar o sistema! Efetue o login.</div>';
      } elseif ($acao == 'sair') {
          echo '<div class="alert alert-warning text-center">Você saiu da Agenda Eletrônica!</div>';
      }
  }

  // Processar login
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
                      header("Refresh: 3; url=paginas/home.php?acao=bemvindo");
                  } else {
                      echo '<div class="alert alert-danger text-center">Senha incorreta!</div>';
                  }
              } else {
                  echo '<div class="alert alert-danger text-center">E-mail não encontrado!</div>';
              }
          } catch (PDOException $e) {
              error_log("ERRO DE LOGIN DO PDO: " . $e->getMessage());
              echo '<div class="alert alert-danger text-center">Erro ao tentar logar. Tente mais tarde.</div>';
          }
      } else {
          echo '<div class="alert alert-danger text-center">Todos os campos são obrigatórios.</div>';
      }
  }
  ?>

  <form method="post" class="mt-3">
    <div class="mb-3">
      <input type="email" name="email" class="form-control" placeholder="Digite seu E-mail..." required>
    </div>
    <div class="mb-3">
      <input type="password" name="senha" class="form-control" placeholder="Digite sua Senha..." required>
    </div>
    <button type="submit" name="login" class="btn btn-primary w-100">Acessar os filmes</button>
  </form>

  <p class="text-center mt-3">
    <a href="cad_user.php" class="text-decoration-none">Ainda não tem cadastro? Clique aqui!</a>
  </p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
