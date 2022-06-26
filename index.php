<?php
require('config.php');

$prefilled = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($_GET['BTenviar'])) {
    $nome = $_GET['nome'];
    $sobrenome = $_GET['sobrenome'];
    $celular = $_GET['celular'];
    $ramal = $_GET['ramal'];
    $email = $_GET['email'];
}
?>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Assinaturas Grupo Dok</title>
    <link rel="stylesheet" href="./css/style.css">

    <link rel="shortcut icon" href="https://grupodok.com.br/wp-content/themes/dok/img/favicon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="./js/html2canvas.min.js"></script>

</head>

<body>
    <div id="tela">
        <header>
            <a href="https://grupodok.com.br">
                <img src="https://grupodok.com.br/wp-content/themes/dok/img/logo-grupodok-3d.png" class="logo"><h1>Grupo Dok</h1></a>
            <h3>Gerador de Assinaturas</h3>
        </header>

        <article>
            <div id="formulario">
                <form role="form" action="<? $PHP_SELF; ?>" method="get">
                    <div class="form-itens">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="nome" required>
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="sobrenome">
                    </div>
                    <div class="form-itens">
                        <label for="funcao">Função:</label>
                        <input type="text" name="funcao" id="funcao" required>
                    </div>
                    <div class="form-itens">
                        <label for="celular">Telefone pessoal:</label>
                        <input type="tel" name="celular" id="celular" placeholder="(XX)XXXXX-XXXX" required>

                        <label for="ramal">Ramal:</label>
                        <input type="number" name="ramal" id="ramal" required>
                    </div>
                    <div class="form-itens">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="botoes">
                        <button type="submit" value="BTenviar" id="BTenviar">Gerar Assinatura</button>
                        <button type="button" onclick="exibir()">Visualizar</button>
                    </div>

                    <hr>
            </div>
            <div id="visualizacao">
                <div id="previewer">
                    <div class="nomeSobrenome">
                        <div class="nome">
                            <span id="nomeP">
                                <?php if (isset($_GET['nome'])) : ?>
                                <?php echo $_GET['nome'] ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="sobrenome">
                            <span id="sobrenomeP">
                                <?php if (isset($_GET['sobrenome'])) : ?>
                                <?php echo $_GET['sobrenome'] ?>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <div class="funcao">
                        <span id="funcaoP">
                            <?php if (isset($_GET['funcao'])) : ?>
                            <?php echo $_GET['funcao'] ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="celularRamalEmail">
                        <div class="celularRamal">
                            <div class="celular">
                                <span id="celularP">
                                    <?php if (isset($_GET['celular'])) : ?>
                                    <?php echo $_GET['celular'] ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="ramal">
                                <span id="ramalP">
                                    <?php if (isset($_GET['ramal'])) : ?>
                                    <?php echo $_GET['ramal'] ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        <div class="email">
                            <span id="emailP">
                                <?php if (isset($_GET['email'])) : ?>
                                <?php echo $_GET['email'] ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="celularRamal">
                            <span id="site"><a href="https://www.grupodok.com.br">www.grupodok.com.br</a></span>
                        </div>
                    </div>
                </div>
                <div id="previewImage"></div>
                </form>
                <div class="botoes" id="botaoSalvar">
                    <a class="download"></a>
                    <button class="gerar-imagem" type="button">Download</button>
                </div>
            </div>

            <script type="text/javascript">
                function exibir() {
                    document.getElementById("visualizacao").style.display = "block";
                }
            </script>

            <script>
                $(document).ready(function () {
                    $('[name="celular"]').mask('(99) 99999-9999');
                });

                let btnGenerate = document.querySelector('.gerar-imagem');
                let btnDownload = document.querySelector('.download');

                btnGenerate.addEventListener('click', () => {
                    html2canvas(document.querySelector("#previewer")).then(canvas => {
                        btnDownload.href = canvas.toDataURL('image/png');
                        btnDownload.download = 'minha-imagem';
                        btnDownload.click();
                    })
                    scale: 4;
                });
            </script>
        </article>
    </div>
</body>

</html>