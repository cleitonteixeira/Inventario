<!doctype html>
<html lang="pt_BR">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css" />
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css" />

        <title>Intranet Nutribem</title>
    </head>
    <body id="fundoLogin">
        <div class="container">

            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="card" id="telaLogin" >
                    <div class="card-body">
                        <h4 class="card-title">Bem Vindo a Intranet Nutribem</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Para continuar, faça o login.</h6>
                        <form action="Controle/Acesso.php" method="POST" enctype="multipart/form-data" data-toggle="validator" >
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login" name="login">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                            <!--<div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="keepOn">
                                <label class="form-check-label" for="keepOn">Manter Conectado</label>
                            </div>-->
                            <button type="submit" class="btn btn-outline-success btn-block ">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
        <script src="codes/js/Validator.min.js"></script>
    </body>
</html>