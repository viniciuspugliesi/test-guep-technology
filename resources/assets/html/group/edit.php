<!DOCTYPE html>
<html>
<head>
    <title>Editar de usuários - Teste Guep</title>
    <?php include(__DIR__ . '/../includes/head.php') ?>
</head>
<body>
    <?php include(__DIR__ . '/../includes/header.php') ?>
    
    <div class="container">
        <h3 class="title mg-20--bottom">Editar <span class="font-16">grupos</span></h3>
        
        <?php include(__DIR__ . '/../includes/messages.php') ?>
        
        <form action="/grupos/editar/<?= $group->id ?>" method="post" name="groups" class="form col-md-6">
            <div class="form-group">
                <label for="name">Nome do grupo: </label>
                <input type="text" name="name" value="<?= $group->name ?>" class="form-control" id="name" placeholder="Nome do grupo">
                <p class="message-js hide" data-message="name"></p>
            </div>
            
            <button class="btn btn-primary">Editar</button>
        </form>
    </div>
    
    <?php include(__DIR__ . '/../includes/footer.php') ?>
    <?php include(__DIR__ . '/../includes/scripts.php') ?>
    <script>
        start.form.groups();
    </script>
</body>
</html>