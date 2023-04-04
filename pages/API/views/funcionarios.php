<?php
include_once("/xampp/htdocs/Shakers/pages/functions/php/functions.php")
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    headFormulario();
    ?>
</head>

<body>
    <?php
    menu();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (!$_GET) {
                    echo "<h3>Cadastrar Funcionário</h3>";
                    $dadosPadrao = json_encode(
                        array(
                            0 => array(
                                "nome_arquivo" => "",
                                "arquivo" => "",
                                "name" => "",
                                "email" => "",
                                "rg" => "",
                                "cpf" => "",
                                "cb" => "",
                                "manequim" => "",
                                "calcado" => "",
                                "altura" => "",
                                "phone" => "",
                                "status" => "",
                                "hierarquia" => "",
                                "idiomas" => "",
                                "created_at" => "",
                                "update_at" => "",
                                "id" => "",
                            )
                        )
                    );
                    $dados = json_decode($dadosPadrao);
                } else {
                    if (isset($_GET["id"]) && !empty($_GET["id"])) {
                        echo "<h3>Editar Funcionarios</h3>";
                        require_once("../model/funcionarios.php");
                        $id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
                        $buscarCliente = new Funcionarios();
                        $resposta = $buscarCliente->carregarCliente($id);
                        $dados = json_decode($resposta);
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- Modal -->
                <div class="modal fade" id="teste" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalCentralizado">Excluir Funcionário</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                erro
                            </div>
                            <div class="modal-footer">
                                <a href=""><button type="button" class="btn btn-danger btn-sm">Sim</button></a>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($dados as $key => $value)
            ?>
            <div class="col-sm-12">
                <form enctype="multipart/form-data" action="../controller/funcionario.php" method="POST">
                    <div class="row h-50">
                        <div class="col-md-0">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="arquivo_gravado" id="arquivo_gravado" value="<?= $value->arquivo; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="file" class="form-control" name="arquivo" id="arquivo">
                            </div>
                            <div class="form-group">
                                <label>Nome do Arquivo</label>
                                <input type="text" class="form-control" name="nome_arquivo" id="nome_arquivo" value="<?= $value->nome_arquivo; ?>">
                            </div>
                            <input type="button" class="excluir btn btn-danger btn-sm" value="Excluir Imagem">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="../../arquivos/<?= substr($value->arquivo, 37); ?> " download="<?= $value->nome_arquivo; ?>">
                                    <img class="img container-image img-responsive img-thumbnail img-fluid mx-auto" <?php if ($value->arquivo) {
                                                                                                                    ?>src="../../arquivos/<?= substr($value->arquivo, 37);
                                                                                                                                        } ?>" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $value->name; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?= $value->email; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>RG</label>
                                <input type="text" class="form-control rg" name="rg" id="rg" value="<?= $value->rg; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?= $value->cpf; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Conta Bancária</label>
                                <input type="text" class="form-control" name="cb" id="cb" value="<?= $value->cb; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control phone_with_ddd" name="phone" id="phone" value="<?= $value->phone; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Manequim</label>
                                    <input type="text" class="form-control" name="manequim" id="manequim" value="<?= $value->manequim; ?>">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Calçado</label>
                                    <input type="text" class="form-control" name="calcado" id="calcado" value="<?= $value->calcado; ?>">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Altura</label>
                                    <input type="text" class="form-control" name="altura" id="altura" value="<?= $value->altura; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>status</label>
                                <select class="form-control" name="status" id="status">
                                    <option name="status" id="status" selected style="display:none"><?= $value->status; ?></option>
                                    <option name="status" id="status" value="<?= $value->status = 'Ativo'; ?>">Ativo</option>
                                    <option name="status" id="status" value="<?= $value->status = 'Inativo'; ?>">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hierarquia</label>
                                <input type="text" class="form-control" name="hierarquia" id="hierarquia" value="<?= $value->hierarquia; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Idiomas</label>
                                <input type="text" class="form-control" name="idiomas" id="idiomas" value="<?= $value->idiomas; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Criado Em</label>
                                <input type="text" class="form-control" name="created_at" id="created_at" value="<?= $value->created_at; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Alterado Em</label>
                                <input type="text" class="form-control" name="update_at" id="update_at" value="<?= $value->update_at; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if ($value->id) {
                            ?>
                                <input type="hidden" class="form-control" name="id" id="id" value="<?= $value->id; ?>">
                                <button type="submit" class="btn btn-success">Editar</button>
                            <?php
                            } else {
                            ?>
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                                <button type="reset" class="btn btn-warning">Limpar</button>
                            <?php
                            }
                            ?>
                            <a href="../../funcionarios.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
                <footer>
                </footer>
            </div>
        </div>
    </div>
    <?php
    rodapeFormulario();
    ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $('.excluir').click(function() {
            // url of the data to be delete
            var ajxReq = $.ajax({
                url: '../../arquivos/<?= substr($value->arquivo, 37);?>',
                type: 'DELETE',
                success: function(data) {
                    $("p").append("Delete request is Success.");
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    $("p").append("Delete request is Fail.");
                }
            });
        });
    });
    /* $(document).ready(function() {
     $(".btn").click(function() {
         $(".container-image").remove();
     });
    });*/
</script>