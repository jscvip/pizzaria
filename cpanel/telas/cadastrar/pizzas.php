<?php
require_once("biblioteca/wideimage/WideImage.php");
if (isset($_POST)) {
    if ($_POST != null) {
        obrigatorio("Nome da Pizza", addslashes($_POST["nome"]), "text");
        obrigatorio("Valor", addslashes($_POST["valor"]), "text");
        obrigatorio("Categoria", addslashes($_POST["categoria"]), "select");
        obrigatorio("Imagem da Pizza", addslashes($_FILES["imagem"]["name"]), "text");


        global $obrigatorio;
        if (empty($obrigatorio)) {

            $foto = $_FILES['imagem']['name'];
            $ext      = explode(".", $foto);
            $extf =end($ext);
            $img_type = $_FILES['imagem']['type'];
            if (preg_match("/(image)/", $img_type)) {
                $temp = $_FILES['imagem']['tmp_name'];

               $nome_foto = tiraespecialeespaco($_POST["nome"]).".".$extf;
               try {
                    $fotos = WideImage::load($temp);
                    $redimensionar = $fotos->resize(105, 80, "fill");
                    $redimensionar->saveToFile("../images/fotos/" . $nome_foto);

                    if ($redimensionar->isValid()) {
                        $redimensionar = $fotos->resize(310, 300, "fill");
                        $redimensionar->saveToFile("../images/detalhes/" . $nome_foto);

                    if (verificaCadastro("pizzas", "nome", $_POST["nome"])) {
                            if (cadastro("pizzas", $_POST, $nome_foto)) {
                                $sucesso = "Pizza gravado com sucesso!";
                                $_POST = null;
                            } else {
                                if(file_exists("../images/fotos/" . $nome_foto) && file_exists("../images/detalhes/" . $nome_foto)) {
                                    if (unlink("../images/fotos/" . $nome_foto) && unlink("../images/detalhes/" . $nome_foto)) {
                                        $erro = "Não foi possivel gravar Pizza!";
                                    }else{
                                        $erro = "Arquivo não pode ser deletado";
                                    }
                                }else{
                                    $erro = "Arquivo não encontrado";
                                }
                            }
                        } else {
                            $erro = "Já existe um Pizza como o Nome: " . $_POST["nome"];
                        }

                    } else {
                        $erro = "Não fo possivel redimensionar a foto!";
                    }

                } catch (WideImage_Exception $e) {
                    $erro = "Erro: " . $e->getMessage();
                }

            } else {
                $erro = "O arquivo enviado não é imagem!";
            }

        } else {
            $erro = $obrigatorio;
        }
    }
}

?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.CADASTRAR PIZZAS.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="categoria" class="col-sm-3 control-label">Categoria: </label>

                <div class="col-sm-9">
                    <select class="form-control" name="categoria" id="categoria">
                        <?php
                        $id = $_POST['categoria'];
                        if (!empty($id)) {
                            $d = listarId("categorias",$id);
                            ?>
                            <option value="<?php echo $d['id']; ?>"><?php echo $d["nome"]; ?></option>
                        <?php
                        } else { ?>
                            <option value="0">Escolha uma categoria</option>
                        <?php
                        }
                        $dados = listar("categorias");
                        if ($dados) {
                            foreach ($dados as $d) {
                                ?>
                                <option value="<?php echo $d['id']; ?>"><?php echo $d['nome']; ?></option>
                            <?php
                            }
                        } else { ?>
                            <option value="0">Nenhuma Categoria cadastrada</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="nome" class="col-sm-3 control-label">Nome da Pizza: </label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nome" name="nome"
                           placeholder="Entre com o nome da Pizza"
                           value="<?php if (!empty($_POST['nome'])) echo $_POST['nome']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="valor" class="col-sm-3 control-label">Valor: </label>

                <div class="col-sm-3">
                    <input type="text" class="form-control" id="valor" name="valor"
                           value="<?php if (!empty($_POST['valor'])) echo $_POST['valor']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="imagem" class="col-sm-3 control-label">Imagem: </label>

                <div class="col-sm-9">
                    <input type="file" class="form-control" id="imagem" name="imagem"
                           placeholder="Entre com imagem da Pizza">
                </div>
            </div>
            <input type="hidden" class="form-control" id="status" name="status" value="1">

            <div class="form-group" style="margin-bottom: 0;">
                <div class="col-sm-offset-2 col-sm-10 text-right">
                    <button type="submit" class="btn btn-success active">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    <?php if (isset($sucesso)) {
        if (!empty($sucesso)) {
            ?>
            <div class="alert alert-success" role="alert"
                 style="margin: 0; padding: 5px;"><?php echo $sucesso; ?></div>
        <?php }
    }
    if (isset($erro)) {
        if (!empty($erro)) {
            ?>
            <div class="alert alert-danger" role="alert" style="margin: 0; padding: 5px;"><?php echo $erro; ?></div>
        <?php }
    } ?>
</div>