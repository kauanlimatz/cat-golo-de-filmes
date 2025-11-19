<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: transparent;">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                        <i class="fas fa-film mr-3"></i>Catálogo de Filmes
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content" style="background: transparent;">
        <div class="container-fluid" style="background: transparent;">
            <div class="row">

                <!-- COLUNA ESQUERDA – CADASTRO -->
                <div class="col-md-4">
                    <div class="card card-primary shadow-lg" style="border: none; border-radius: 15px;">
                        <div class="card-header" style="background: linear-gradient(45deg, #007bff, #0056b3); border-radius: 15px 15px 0 0;">
                            <h3 class="card-title mb-0" style="color: white;">
                                <i class="fas fa-plus-circle mr-2"></i>Cadastrar Filme
                            </h3>
                        </div>

                        <!-- Formulário -->
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="card-body" style="background: #f8f9fa;">

                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-film mr-2 text-primary"></i>Título do Filme</label>
                                    <input type="text" class="form-control shadow-sm" name="titulo" required placeholder="Digite o nome do filme" style="border-radius: 8px;">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-clock mr-2 text-primary"></i>Duração (minutos)</label>
                                    <input type="number" class="form-control shadow-sm" name="duracao" required placeholder="Ex: 120" style="border-radius: 8px;">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-tag mr-2 text-primary"></i>Gênero</label>
                                    <input type="text" class="form-control shadow-sm" name="genero" required placeholder="Ex: Ação, Comédia, Drama" style="border-radius: 8px;">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-certificate mr-2 text-primary"></i>Classificação</label>
                                    <input type="text" class="form-control shadow-sm" name="classificacao" required placeholder="Ex: Livre, 10, 12, 14, 16, 18" style="border-radius: 8px;">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-image mr-2 text-primary"></i>Cartaz do Filme</label>
                                    <div class="custom-file">
                                        <input type="file" name="cartaz" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile" style="border-radius: 8px;">Selecione uma imagem</label>
                                    </div>
                                </div>

                                <input type="hidden" name="id_user" value="<?php echo $id_user ?>">

                            </div>

                            <div class="card-footer" style="background: #f8f9fa; border-radius: 0 0 15px 15px;">
                                <button type="submit" name="botao" class="btn btn-primary btn-block py-2 shadow" style="border-radius: 8px; font-weight: bold; background: linear-gradient(45deg, #007bff, #0056b3); border: none;">
                                    <i class="fas fa-save mr-2"></i>Cadastrar Filme
                                </button>
                            </div>
                        </form>

                        <?php
                        include('../config/conexao.php');

                        if (isset($_POST['botao'])) {

                            $titulo = $_POST['titulo'];
                            $duracao = $_POST['duracao'];
                            $genero = $_POST['genero'];
                            $classificacao = $_POST['classificacao'];
                            $id_usuario = $_POST['id_user'];

                            $formatP = array("png", "jpg", "jpeg", "JPG", "gif");

                            if (isset($_FILES['cartaz'])) {

                                $ext = pathinfo($_FILES['cartaz']['name'], PATHINFO_EXTENSION);

                                if (in_array($ext, $formatP)) {

                                    $pasta = "../img/cartaz/";
                                    $tmp = $_FILES['cartaz']['tmp_name'];
                                    $novo = uniqid() . ".$ext";

                                    if (move_uploaded_file($tmp, $pasta . $novo)) {
                                        $cartaz = $novo;
                                    } else {
                                        $cartaz = "padrao_filme.png";
                                    }

                                } else {
                                    $cartaz = "padrao_filme.png";
                                }
                            }

                            $cad = "INSERT INTO tb_filmes (titulo, duracao, genero, classificacao, cartaz, id_user)
                                    VALUES (:titulo, :duracao, :genero, :classificacao, :cartaz, :id_user)";

                            try {
                                $r = $conect->prepare($cad);
                                $r->bindParam(':titulo', $titulo);
                                $r->bindParam(':duracao', $duracao);
                                $r->bindParam(':genero', $genero);
                                $r->bindParam(':classificacao', $classificacao);
                                $r->bindParam(':cartaz', $cartaz);
                                $r->bindParam(':id_user', $id_usuario);
                                $r->execute();

                                echo '<div class="container">
                                    <div class="alert alert-success alert-dismissible mt-2 shadow" style="border-radius: 10px; border: none;">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <h5><i class="icon fas fa-check"></i> Filme cadastrado com sucesso!</h5>
                                    </div>
                                </div>';

                                header("Refresh: 2");

                            } catch (PDOException $e) {
                                echo '<div class="alert alert-danger alert-dismissible mt-2 shadow" style="border-radius: 10px; border: none;">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Erro: ' . $e->getMessage() . '</h5>
                                    </div>';
                            }
                        }
                        ?>

                    </div>
                </div>

                <!-- LISTAGEM DOS FILMES -->
                <div class="col-md-8">

                    <div class="card shadow-lg" style="border: none; border-radius: 15px;">
                        <div class="card-header text-white" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 15px 15px 0 0;">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-star mr-2"></i>Filmes em Cartaz
                            </h3>
                            <small class="font-weight-light">Seus filmes favoritos em destaque</small>
                        </div>

                        <div class="card-body" style="background: #f8f9fa; border-radius: 0 0 15px 15px;">

                            <div class="row">

                                <?php
                                $sel = "SELECT * FROM tb_filmes WHERE id_user = :id_user ORDER BY id DESC LIMIT 8";

                                try {
                                    $r = $conect->prepare($sel);
                                    $r->bindParam(":id_user", $id_user);
                                    $r->execute();

                                    if ($r->rowCount() > 0) {
                                        while ($f = $r->fetch(PDO::FETCH_OBJ)) {
                                ?>

                                <!-- CARD DO FILME SUPER MELHORADO -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm" style="border: none; border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                        <div style="position: relative; overflow: hidden; border-radius: 12px 12px 0 0;">
                                            <img src="../img/cartaz/<?php echo $f->cartaz ?>" 
                                                class="card-img-top" 
                                                style="height: 300px; object-fit: cover; transition: transform 0.3s ease;">
                                            <div class="card-img-overlay d-flex align-items-end" style="background: linear-gradient(transparent 40%, rgba(0,0,0,0.8));">
                                                <h5 class="card-title text-white mb-0 text-truncate"><?php echo $f->titulo ?></h5>
                                            </div>
                                        </div>

                                        <div class="card-body d-flex flex-column" style="background: white;">
                                            <div class="movie-info mt-auto">
                                                <p class="mb-2 small text-muted"><i class="fas fa-clock mr-2 text-primary"></i><b>Duração:</b> <?php echo $f->duracao ?> min</p>
                                                <p class="mb-2 small text-muted"><i class="fas fa-tag mr-2 text-success"></i><b>Gênero:</b> <?php echo $f->genero ?></p>
                                                <p class="mb-2 small text-muted"><i class="fas fa-certificate mr-2 text-warning"></i><b>Classificação:</b> <?php echo $f->classificacao ?></p>
                                            </div>
                                        </div>

                                        <div class="card-footer bg-white border-top-0" style="border-radius: 0 0 12px 12px;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="home.php?acao=editar&id=<?php echo $f->id ?>" 
                                                   class="btn btn-success btn-sm shadow" 
                                                   style="border-radius: 20px;"
                                                   title="Editar filme">
                                                    <i class="fas fa-edit mr-1"></i> Editar
                                                </a>

                                                <a href="conteudo/del-filme.php?idDel=<?php echo $f->id ?>"
                                                   onclick="return confirm('Tem certeza que deseja remover este filme?')"
                                                   class="btn btn-danger btn-sm shadow"
                                                   style="border-radius: 20px;"
                                                   title="Excluir filme">
                                                    <i class="fas fa-trash mr-1"></i> Excluir
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                        }
                                    } else {
                                        echo '<div class="col-12 text-center py-5">
                                                <div class="alert alert-info shadow" style="border-radius: 15px; border: none; background: linear-gradient(45deg, #17a2b8, #6f42c1); color: white;">
                                                    <i class="fas fa-film fa-4x mb-3" style="opacity: 0.8;"></i>
                                                    <h3>Nenhum filme cadastrado ainda!</h3>
                                                    <p class="mb-0 mt-2">Comece adicionando seu primeiro filme usando o formulário ao lado.</p>
                                                </div>
                                            </div>';
                                    }

                                } catch (PDOException $e) {
                                    echo '<div class="alert alert-danger alert-dismissible shadow m-3" style="border-radius: 10px; border: none;">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> Erro: ' . $e->getMessage() . '</h5>
                                        </div>';
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- FIM LISTA -->

            </div>
        </div>
    </section>

</div>

</body>