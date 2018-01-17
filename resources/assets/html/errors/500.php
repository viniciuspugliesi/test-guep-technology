<!DOCTYPE html>
<html>
<head>
    <title>Erro interno - Teste Guep</title>
    <?php include(__DIR__ . '/../includes/head.php') ?>
</head>
<body>
    <div class="error-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-container">
                        <h1>Oops!</h1>
                        <h2>500 - Erro interno</h2>
                        
                        <p class="mg-30--top">
                            Desculpe, ocorreu algum erro interno.
                        </p>
                        
                        <div class="mg-20--top">
                            <a href="/" class="btn btn-primary btn-lg">Voltar para Home</a>
                        </div>
                        
                        <hr>
                        
                        <?php if (isset($e)) : ?>
                            <div class="mg-30--top">
                                <h3>Informações do erro</h3>
                                
                                <?php if (strripos($e['message'], 'PDO')) : ?>
                                    <p>Verifique os dados de conexão com o banco de dados.</p>
                                <?php else : ?>
                                    <p><?= $e['message'] ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include(__DIR__ . '/../includes/scripts.php') ?>
</body>
</html>