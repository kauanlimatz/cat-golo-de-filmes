<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catálogo de Filmes</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- COLUNA ESQUERDA – CADASTRO -->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cadastrar Filme</h3>
                        </div>

                        <!-- Formulário -->
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Título do Filme</label>
                                    <input type="text" class="form-control" name="titulo" required placeholder="Digite o nome do filme">
                                </div>

                                <div class="form-group">
                                    <label>Duração (minutos)</label>
                                    <input type="number" class="form-control" name="duracao" required placeholder="Ex: 120">
                                </div>

                                <div class="form-group">
                                    <label>Gênero</label>
                                    <input type="text" class="form-control" name="genero" required placeholder="Ex: Ação, Comédia, Drama">
                                </div>

                                <div class="form-group">
                                    <label>Classificação</label>
                                    <input type="text" class="form-control" name="classificacao" required placeholder="Ex: Livre, 10, 12, 14, 16, 18">
                                </div>

                                <div class="form-group">
                                    <label>Cartaz do Filme</label>
                                    <div class="custom-file">
                                        <input type="file" name="cartaz" class="custom-file-input">
                                        <label class="custom-file-label">Selecione uma imagem</label>
                                    </div>
                                </div>

                                <input type="hidden" name="id_user" value="<?php echo $id_user ?>">

                            </div>

                            <div class="card-footer">
                                <button type="submit" name="botao" class="btn btn-primary">Cadastrar Filme</button>
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
                                    <div class="alert alert-success alert-dismissible mt-2">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <h5><i class="icon fas fa-check"></i> Filme cadastrado com sucesso!</h5>
                                    </div>
                                </div>';

                                header("Refresh: 2");

                            } catch (PDOException $e) {
                                echo "Erro: " . $e->getMessage();
                            }
                        }
                        ?>

                    </div>
                </div>

                <!-- LISTAGEM DOS FILMES -->
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filmes Recentes</h3>
                        </div>

                        <div class="card-body">

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

                                <!-- CARD DO FILME -->
                                <div class="col-md-4 mb-3">
                                    <div class="card" style="min-height: 420px;">
                                        
                                        <img src="../img/cartaz/<?php echo $f->cartaz ?>" 
                                            class="card-img-top" 
                                            style="height: 250px; object-fit: cover;">

                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $f->titulo ?></h5>

                                            <p class="mb-1"><b>Duração:</b> <?php echo $f->duracao ?> min</p>
                                            <p class="mb-1"><b>Gênero:</b> <?php echo $f->genero ?></p>
                                            <p class="mb-1"><b>Classificação:</b> <?php echo $f->classificacao ?></p>
                                        </div>

                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="home.php?acao=editar&id=<?php echo $f->id ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="conteudo/del-filme.php?idDel=<?php echo $f->id ?>"
                                               onclick="return confirm('Deseja remover este filme?')"
                                               class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>

                                <?php
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger ml-3">Nenhum filme cadastrado!</div>';
                                    }

                                } catch (PDOException $e) {
                                    echo "Erro: " . $e->getMessage();
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