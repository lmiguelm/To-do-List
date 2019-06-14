<?php
    include "valida_cookies.inc";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>To-Do List</title>
    <meta name="viewport" 
        content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" 
        href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" 
        href="../css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" type="text/css" 
        href="../css/todo.css" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/icon?family=Material+Icons" />
</head>
<body>
    
    <nav class="navbar navbar-dark bg-dark 
        navbar-expand-md fixed-top">
        <!-- Brand -->
        <a href="todo.php" 
            class="navbar-brand logotipo">
            <img src="../img/to-do.jpg" alt="Logotipo" />
        </a>
        
        <!-- botão toggler -->
        <button type="button" class="navbar-toggler"
            data-toggle="collapse" 
            data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- menu -->
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">Novas Tarefas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Tarefas em aberto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Tarefas concluídas</a>
                </li>
            </ul>
            <div class="btn-group">
                <button type="button" class="btn btn-secondary
                    dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Minha conta
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">
                        <?php echo $_COOKIE["nome"]; ?>
                    </button>
                    <button class="dropdown-item" type="button">
                        Alterar perfil</button>
                    <button class="dropdown-item" type="button"
                        id="btnLogout">Sair</button>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="table-responsive">
            <table class="dados-list table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tarefa-list">
                </tbody>
            </table>
            <footer class="row">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NovaTarefa">
                        Nova Tarefa</button>
                </div>
                <div class="col-sm-6 paginacao text-right">
                    <ul class="pagination">
                    </ul>
                </div>
            </footer>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" 
        id="NovaTarefa">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nova Tarefa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="salvarTarefa.php" 
                method="POST">
                <div class="modal-body">

                    <input type="hidden" name="id" id="id" value="0"/>
                    <input type="hidden" name="id_usuario" 
                        id="id_usuario"
                        value="<?php echo $_COOKIE["id_usuario"]; ?>" />

                    <div class="row">
                        <div class="form-group col-sm-8 col-xs-12">
                            <label for="descricao">Descrição:</label>
                            <input type="text" name="descricao"
                            id="descricao" class="form-control"
                            required="required" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required="required">
                                <option value="">Selecione...</option>
                                <option value="1">Nova</option>
                                <option value="2">Em andamento</option>
                                <option value="3">Finalizada</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label for="data">Data:</label>
                            <div class="input-group date" 
                                data-provide="datepicker"
                                data-date-language="pt-BR">
                                <input type="text" name="data"
                                    class="form-control data" id="data"
                                    required="required" />
                                <div class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" >Limpar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
            </div>
        </div>
      </div>
    
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
    <script src="../js/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="../js/jquery.cookie.js"></script>
    <script src="../js/todo.js"></script>
</body>
</html>