<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Catálogo de Filmes | Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --primary: #e50914;
      --primary-dark: #b2070f;
      --secondary: #f5c518;
      --dark: #141414;
      --darker: #0a0a0a;
      --light: #ffffff;
      --gray: #8c8c8c;
      --dark-gray: #2d2d2d;
      --card-bg: #1a1a1a;
    }
    
    body {
      background: linear-gradient(135deg, var(--darker), var(--dark));
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      color: var(--light);
      overflow-x: hidden;
      position: relative;
    }

    /* Efeito de luzes de cinema */
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, 
        transparent 0%, 
        var(--primary) 20%, 
        var(--secondary) 40%, 
        var(--primary) 60%, 
        var(--secondary) 80%, 
        transparent 100%);
      box-shadow: 0 0 15px var(--primary), 0 0 30px var(--primary);
      z-index: 10;
      animation: lightBar 3s infinite linear;
    }

    @keyframes lightBar {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    .content-wrapper {
      background: transparent !important;
      padding: 20px;
    }

    /* Header Styles */
    .content-header h1 {
      color: var(--light);
      text-shadow: 0 2px 10px rgba(0,0,0,0.7);
      font-weight: 700;
      background: linear-gradient(to right, var(--light), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 2.5rem;
    }

    /* Card Styles */
    .custom-card {
      border: none;
      border-radius: 15px;
      background: var(--card-bg);
      box-shadow: 0 10px 35px rgba(0,0,0,0.8);
      overflow: hidden;
      position: relative;
    }

    .custom-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, 
        var(--primary) 0%, 
        var(--secondary) 50%, 
        var(--primary) 100%);
      z-index: 1;
    }

    .card-header-custom {
      background: linear-gradient(45deg, var(--dark), var(--darker));
      border-radius: 15px 15px 0 0;
      border-bottom: 2px solid var(--primary);
      padding: 1.5rem;
    }

    .card-header-custom h3 {
      color: var(--light);
      font-weight: 700;
      margin: 0;
    }

    .card-body-custom {
      background: var(--dark);
      padding: 2rem;
    }

    /* Form Styles */
    .form-group label {
      font-weight: 600;
      color: var(--light);
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-control-custom {
      height: 50px;
      border-radius: 8px;
      background: rgba(45, 45, 45, 0.7);
      border: 1px solid var(--dark-gray);
      color: var(--light);
      padding: 12px 15px;
      transition: all 0.3s ease;
    }

    .form-control-custom:focus {
      background: rgba(60, 60, 60, 0.8);
      border-color: var(--primary);
      box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25);
      color: var(--light);
    }

    .form-control-custom::placeholder {
      color: var(--gray);
    }

    .form-select-custom {
      height: 50px;
      border-radius: 8px;
      background: rgba(45, 45, 45, 0.7);
      border: 1px solid var(--dark-gray);
      color: var(--light);
      padding: 12px 15px;
      transition: all 0.3s ease;
    }

    .form-select-custom:focus {
      background: rgba(60, 60, 60, 0.8);
      border-color: var(--primary);
      box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25);
      color: var(--light);
    }

    /* Button Styles */
    .btn-custom-primary {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border: none;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 12px 25px;
      border-radius: 8px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(229, 9, 20, 0.4);
      position: relative;
      overflow: hidden;
      color: var(--light);
    }

    .btn-custom-primary:hover {
      background: linear-gradient(135deg, var(--primary-dark), var(--primary));
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(229, 9, 20, 0.6);
      color: var(--light);
    }

    .btn-custom-primary:active {
      transform: translateY(0);
    }

    .btn-custom-success {
      background: linear-gradient(135deg, #27ae60, #229954);
      border: none;
      color: var(--light);
      border-radius: 20px;
      padding: 8px 15px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-custom-success:hover {
      background: linear-gradient(135deg, #229954, #27ae60);
      transform: translateY(-2px);
      color: var(--light);
    }

    .btn-custom-danger {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      border: none;
      color: var(--light);
      border-radius: 20px;
      padding: 8px 15px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-custom-danger:hover {
      background: linear-gradient(135deg, #c0392b, #e74c3c);
      transform: translateY(-2px);
      color: var(--light);
    }

    /* Movie Cards */
    .movie-card {
      border: none;
      border-radius: 12px;
      background: var(--card-bg);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      height: 100%;
    }

    .movie-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(229, 9, 20, 0.3);
    }

    .movie-card-img {
      height: 300px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .movie-card:hover .movie-card-img {
      transform: scale(1.05);
    }

    .movie-card-overlay {
      background: linear-gradient(transparent 40%, rgba(0,0,0,0.8));
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 20px;
    }

    .movie-card-title {
      color: var(--light);
      font-weight: 700;
      font-size: 1.1rem;
      margin: 0;
    }

    .movie-info {
      color: var(--gray);
      font-size: 0.9rem;
    }

    .movie-info b {
      color: var(--light);
    }

    /* Alert Styles */
    .alert-custom {
      border-radius: 8px;
      border: none;
      font-weight: 500;
      margin-bottom: 1.5rem;
    }

    .alert-success-custom {
      background-color: rgba(40, 167, 69, 0.2);
      color: #28a745;
      border-left: 4px solid #28a745;
    }

    .alert-danger-custom {
      background-color: rgba(220, 53, 69, 0.2);
      color: #dc3545;
      border-left: 4px solid #dc3545;
    }

    /* Efeitos de fundo */
    .bg-lights {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
    }

    .light {
      position: absolute;
      width: 4px;
      height: 100px;
      background: rgba(245, 197, 24, 0.2);
      box-shadow: 0 0 10px 2px rgba(245, 197, 24, 0.5);
      animation: lightMove 8s linear infinite;
    }

    @keyframes lightMove {
      0% {
        transform: translateY(-100px) rotate(0deg);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      90% {
        opacity: 1;
      }
      100% {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0;
      }
    }

    /* Cortinas laterais */
    .curtain {
      position: fixed;
      top: 0;
      width: 20%;
      height: 100%;
      background: linear-gradient(to right, rgba(20, 20, 20, 0.9), rgba(20, 20, 20, 0.7));
      z-index: -1;
    }

    .curtain-left {
      left: 0;
      background: linear-gradient(to right, rgba(20, 20, 20, 0.9), transparent);
    }

    .curtain-right {
      right: 0;
      background: linear-gradient(to left, rgba(20, 20, 20, 0.9), transparent);
    }

    /* Tela de cinema */
    .screen {
      position: fixed;
      top: 20%;
      left: 25%;
      width: 50%;
      height: 10px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      box-shadow: 0 0 60px 30px rgba(255, 255, 255, 0.1);
      z-index: -1;
    }

    /* Estilo para seção de agendamentos */
    .section-title {
      font-size: 1.8rem;
      color: var(--secondary);
      margin: 30px 0 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--primary);
    }

    @media (max-width: 768px) {
      .curtain {
        width: 10%;
      }
      .screen {
        left: 15%;
        width: 70%;
      }
      .content-header h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <!-- Efeito de cortinas laterais -->
  <div class="curtain curtain-left"></div>
  <div class="curtain curtain-right"></div>

  <!-- Efeito de tela de cinema -->
  <div class="screen"></div>

  <!-- Efeito de luzes de fundo -->
  <div class="bg-lights" id="bgLights"></div>

<!-- Content Wrapper -->
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-12 text-center">
                    <h1>
                        <i class="fas fa-film me-3"></i>Agendar Sessão
                    </h1>
                    <p class="mt-2" style="color: var(--gray); font-size: 1.1rem;">
                        Escolha seu filme e faça sua reserva
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- COLUNA ESQUERDA – AGENDAMENTO -->
                <div class="col-md-4 mb-4">
                    <div class="custom-card">
                        <div class="card-header-custom">
                            <h3>
                                <i class="fas fa-calendar-plus me-2"></i>Agendar Filme
                            </h3>
                        </div>

                        <!-- Formulário de Agendamento -->
                        <form role="form" action="" method="post">
                            <div class="card-body-custom">

                                <div class="form-group mb-3">
                                    <label><i class="fas fa-user" style="color: var(--primary);"></i>Seu Nome</label>
                                    <input type="text" class="form-control-custom form-control" name="nome_usuario" required placeholder="Digite seu nome completo">
                                </div>

                                <div class="form-group mb-3">
                                    <label><i class="fas fa-film" style="color: var(--primary);"></i>Filme Escolhido</label>
                                    <select class="form-select-custom form-select" name="filme_escolhido" required>
                                        <option value="">Selecione um filme</option>
                                        <option value="THUNDERBOLTS">THUNDERBOLTS</option>
                                        <option value="BAILARINA">BAILARINA</option>
                                        <option value="OUTRO">Outro filme</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label><i class="fas fa-clock" style="color: var(--primary);"></i>Horário da Sessão</label>
                                    <select class="form-select-custom form-select" name="horario" required>
                                        <option value="">Selecione o horário</option>
                                        <option value="14:00">14:00</option>
                                        <option value="16:30">16:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="21:30">21:30</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label><i class="fas fa-map-marker-alt" style="color: var(--primary);"></i>Local/Cinema</label>
                                    <select class="form-select-custom form-select" name="local" required>
                                        <option value="">Selecione o cinema</option>
                                        <option value="Cinema Shopping Center">Cinema Shopping Center</option>
                                        <option value="Cinema Downtown">Cinema Downtown</option>
                                        <option value="Cinema Plaza">Cinema Plaza</option>
                                        <option value="Cinema Metrópole">Cinema Metrópole</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label><i class="fas fa-tag" style="color: var(--primary);"></i>Gênero do Filme</label>
                                    <select class="form-select-custom form-select" name="genero" required>
                                        <option value="">Selecione o gênero</option>
                                        <option value="Ação">Ação</option>
                                        <option value="Aventura">Aventura</option>
                                        <option value="Comédia">Comédia</option>
                                        <option value="Drama">Drama</option>
                                        <option value="Suspense">Suspense</option>
                                        <option value="Terror">Terror</option>
                                        <option value="Ficção Científica">Ficção Científica</option>
                                        <option value="Romance">Romance</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label><i class="fas fa-certificate" style="color: var(--primary);"></i>Classificação</label>
                                    <select class="form-select-custom form-select" name="classificacao" required>
                                        <option value="">Selecione a classificação</option>
                                        <option value="Livre">Livre</option>
                                        <option value="10 anos">10 anos</option>
                                        <option value="12 anos">12 anos</option>
                                        <option value="14 anos">14 anos</option>
                                        <option value="16 anos">16 anos</option>
                                        <option value="18 anos">18 anos</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label><i class="fas fa-clock" style="color: var(--primary);"></i>Duração (minutos)</label>
                                    <input type="number" class="form-control-custom form-control" name="duracao" required placeholder="Ex: 120" min="60" max="240">
                                </div>

                                <input type="hidden" name="id_user" value="<?php echo $id_user ?>">

                            </div>

                            <div class="card-footer" style="background: var(--dark); border-radius: 0 0 15px 15px; border-top: 2px solid var(--dark-gray); padding: 1.5rem;">
                                <button type="submit" name="agendar" class="btn-custom-primary btn w-100 py-2">
                                    <i class="fas fa-ticket-alt me-2"></i>Confirmar Agendamento
                                </button>
                            </div>
                        </form>

                        <?php
                        include('../config/conexao.php');

                        if (isset($_POST['agendar'])) {

                            $nome_usuario = $_POST['nome_usuario'];
                            $filme_escolhido = $_POST['filme_escolhido'];
                            $horario = $_POST['horario'];
                            $local = $_POST['local'];
                            $genero = $_POST['genero'];
                            $classificacao = $_POST['classificacao'];
                            $duracao = $_POST['duracao'];
                            $id_usuario = $_POST['id_user'];

                            // Definir a imagem do cartaz baseado no filme escolhido
                            if ($filme_escolhido == "THUNDERBOLTS") {
                                $cartaz = "thunderbolts_fixed.jpg";
                            } elseif ($filme_escolhido == "BAILARINA") {
                                $cartaz = "bailarina_fixed.jpg";
                            } else {
                                $cartaz = "padrao_filme.png";
                            }

                            $cad = "INSERT INTO tb_filmes (titulo, duracao, genero, classificacao, cartaz, id_user, nome_usuario, horario, local_cinema)
                                    VALUES (:titulo, :duracao, :genero, :classificacao, :cartaz, :id_user, :nome_usuario, :horario, :local_cinema)";

                            try {
                                $r = $conect->prepare($cad);
                                $r->bindParam(':titulo', $filme_escolhido);
                                $r->bindParam(':duracao', $duracao);
                                $r->bindParam(':genero', $genero);
                                $r->bindParam(':classificacao', $classificacao);
                                $r->bindParam(':cartaz', $cartaz);
                                $r->bindParam(':id_user', $id_usuario);
                                $r->bindParam(':nome_usuario', $nome_usuario);
                                $r->bindParam(':horario', $horario);
                                $r->bindParam(':local_cinema', $local);
                                $r->execute();

                                echo '<div class="alert-custom alert-success-custom p-3">
                                        <i class="fas fa-check me-2"></i> Agendamento realizado com sucesso!
                                      </div>';

                            } catch (PDOException $e) {
                                echo '<div class="alert-custom alert-danger-custom p-3">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Erro: ' . $e->getMessage() . '
                                      </div>';
                            }
                        }
                        ?>

                    </div>
                </div>

                <!-- COLUNA DIREITA – FILMES DISPONÍVEIS E AGENDAMENTOS -->
                <div class="col-md-8">

                    <!-- SEÇÃO: FILMES DISPONÍVEIS -->
                    <div class="custom-card mb-4">
                        <div class="card-header-custom" style="background: linear-gradient(45deg, var(--primary), var(--primary-dark));">
                            <h3>
                                <i class="fas fa-film me-2"></i>Filmes Disponíveis
                            </h3>
                        </div>

                        <div class="card-body-custom">
                            <div class="row">

                                <!-- CARD DO THUNDERBOLTS - FIXO -->
                                <div class="col-md-6 mb-4">
                                    <div class="movie-card">
                                        <div style="position: relative; overflow: hidden;">
                                            <img src="/index/2k25-main/filmes/Thunderbolts.jpg" 
                                                class="movie-card-img" 
                                                alt="Thunderbolts">
                                            <div class="movie-card-overlay d-flex align-items-end">
                                                <h5 class="movie-card-title">THUNDERBOLTS</h5>
                                            </div>
                                        </div>

                                        <div class="card-body d-flex flex-column" style="background: var(--dark);">
                                            <div class="movie-info mt-auto">
                                                <p class="mb-2 small"><i class="fas fa-user me-2" style="color: var(--secondary);"></i><b>Disponível</b></p>
                                                <p class="mb-2 small"><i class="fas fa-clock me-2" style="color: var(--primary);"></i><b>Duração:</b> 142 min</p>
                                                <p class="mb-2 small"><i class="fas fa-tag me-2" style="color: var(--secondary);"></i><b>Gênero:</b> Ação, Aventura</p>
                                                <p class="mb-2 small"><i class="fas fa-certificate me-2" style="color: #f39c12;"></i><b>Classificação:</b> 14 anos</p>
                                            </div>
                                        </div>

                                        <div class="card-footer border-top-0" style="background: var(--dark); border-top: 2px solid var(--dark-gray); padding: 1rem;">
                                            <div class="d-flex justify-content-center">
                                                <span class="badge bg-success">FILME DISPONÍVEL</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- CARD DA BAILARINA - FIXO -->
                                <div class="col-md-6 mb-4">
                                    <div class="movie-card">
                                        <div style="position: relative; overflow: hidden;">
                                            <img src="/index/2k25-main/filmes/Bailarina.jpeg" 
                                                class="movie-card-img" 
                                                alt="Bailarina">
                                            <div class="movie-card-overlay d-flex align-items-end">
                                                <h5 class="movie-card-title">BAILARINA</h5>
                                            </div>
                                        </div>

                                        <div class="card-body d-flex flex-column" style="background: var(--dark);">
                                            <div class="movie-info mt-auto">
                                                <p class="mb-2 small"><i class="fas fa-user me-2" style="color: var(--secondary);"></i><b>Disponível</b></p>
                                                <p class="mb-2 small"><i class="fas fa-clock me-2" style="color: var(--primary);"></i><b>Duração:</b> 118 min</p>
                                                <p class="mb-2 small"><i class="fas fa-tag me-2" style="color: var(--secondary);"></i><b>Gênero:</b> Ação, Suspense</p>
                                                <p class="mb-2 small"><i class="fas fa-certificate me-2" style="color: #f39c12;"></i><b>Classificação:</b> 16 anos</p>
                                            </div>
                                        </div>

                                        <div class="card-footer border-top-0" style="background: var(--dark); border-top: 2px solid var(--dark-gray); padding: 1rem;">
                                            <div class="d-flex justify-content-center">
                                                <span class="badge bg-success">FILME DISPONÍVEL</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- SEÇÃO: MEUS AGENDAMENTOS -->
                    <div class="custom-card">
                        <div class="card-header-custom" style="background: linear-gradient(45deg, #27ae60, #229954);">
                            <h3>
                                <i class="fas fa-calendar-check me-2"></i>Meus Agendamentos
                            </h3>
                        </div>

                        <div class="card-body-custom">
                            <div class="row">

                                <?php
                                $sel = "SELECT * FROM tb_filmes WHERE id_user = :id_user ORDER BY id DESC LIMIT 6";

                                try {
                                    $r = $conect->prepare($sel);
                                    $r->bindParam(":id_user", $id_user);
                                    $r->execute();

                                    if ($r->rowCount() > 0) {
                                        while ($f = $r->fetch(PDO::FETCH_OBJ)) {
                                ?>

                                <!-- CARD DOS AGENDAMENTOS DO USUÁRIO -->
                                <div class="col-md-6 mb-4">
                                    <div class="movie-card">
                                        <div style="position: relative; overflow: hidden;">
                                            <?php if ($f->titulo == "THUNDERBOLTS"): ?>
                                                <img src="/index/2k25-main/filmes/Thunderbolts.jpg" class="movie-card-img" alt="Thunderbolts">
                                            <?php elseif ($f->titulo == "BAILARINA"): ?>
                                                <img src="/index/2k25-main/filmes/Bailarina.jpeg" class="movie-card-img" alt="Bailarina">
                                            <?php else: ?>
                                                <img src="../img/cartaz/<?php echo $f->cartaz ?>" class="movie-card-img" alt="<?php echo $f->titulo ?>">
                                            <?php endif; ?>
                                            <div class="movie-card-overlay d-flex align-items-end">
                                                <h5 class="movie-card-title"><?php echo $f->titulo ?></h5>
                                            </div>
                                        </div>

                                        <div class="card-body d-flex flex-column" style="background: var(--dark);">
                                            <div class="movie-info mt-auto">
                                                <p class="mb-2 small"><i class="fas fa-user me-2" style="color: var(--secondary);"></i><b>Reservado por:</b> <?php echo $f->nome_usuario ?></p>
                                                <p class="mb-2 small"><i class="fas fa-clock me-2" style="color: var(--primary);"></i><b>Horário:</b> <?php echo $f->horario ?></p>
                                                <p class="mb-2 small"><i class="fas fa-map-marker-alt me-2" style="color: #e74c3c;"></i><b>Local:</b> <?php echo $f->local_cinema ?></p>
                                                <p class="mb-2 small"><i class="fas fa-tag me-2" style="color: var(--secondary);"></i><b>Gênero:</b> <?php echo $f->genero ?></p>
                                                <p class="mb-2 small"><i class="fas fa-certificate me-2" style="color: #f39c12;"></i><b>Classificação:</b> <?php echo $f->classificacao ?></p>
                                            </div>
                                        </div>

                                        <div class="card-footer border-top-0" style="background: var(--dark); border-top: 2px solid var(--dark-gray); padding: 1rem;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="home.php?acao=editar&id=<?php echo $f->id ?>" 
                                                   class="btn-custom-success btn btn-sm" 
                                                   title="Editar agendamento">
                                                    <i class="fas fa-edit me-1"></i> Editar
                                                </a>

                                                <a href="conteudo/del-filme.php?idDel=<?php echo $f->id ?>"
                                                   onclick="return confirm('Tem certeza que deseja cancelar este agendamento?')"
                                                   class="btn-custom-danger btn btn-sm"
                                                   title="Cancelar agendamento">
                                                    <i class="fas fa-trash me-1"></i> Cancelar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                        }
                                    } else {
                                        echo '<div class="col-12 text-center py-4">
                                                <i class="fas fa-film fa-3x mb-3" style="color: var(--gray);"></i>
                                                <h4 style="color: var(--gray);">Nenhum agendamento encontrado</h4>
                                                <p style="color: var(--gray);">Faça seu primeiro agendamento usando o formulário ao lado.</p>
                                              </div>';
                                    }

                                } catch (PDOException $e) {
                                    echo '<div class="alert-custom alert-danger-custom p-3 m-3">
                                            <i class="fas fa-exclamation-triangle me-2"></i> Erro: ' . $e->getMessage() . '
                                          </div>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- FIM COLUNA DIREITA -->

            </div>
        </div>
    </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Criar efeito de luzes de fundo dinâmicas
  document.addEventListener('DOMContentLoaded', function() {
    const bgLights = document.getElementById('bgLights');
    const lightCount = 15;
    
    for (let i = 0; i < lightCount; i++) {
      const light = document.createElement('div');
      light.classList.add('light');
      
      const left = Math.random() * 100;
      const animationDelay = Math.random() * 8;
      const animationDuration = 5 + Math.random() * 5;
      
      light.style.left = `${left}%`;
      light.style.animationDelay = `${animationDelay}s`;
      light.style.animationDuration = `${animationDuration}s`;
      
      bgLights.appendChild(light);
    }
  });
</script>
</body>
</html>