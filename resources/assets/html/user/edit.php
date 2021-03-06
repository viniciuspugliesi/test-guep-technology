<!DOCTYPE html>
<html>
<head>
    <title>Editar usuário - Teste Guep</title>
    <?php include(__DIR__ . '/../includes/head.php') ?>
</head>
<body>
    <?php include(__DIR__ . '/../includes/header.php') ?>
    
    <div class="container">
        <h3 class="title mg-20--bottom">Editar <span class="font-16">usuários</span></h3>
        
        <?php include(__DIR__ . '/../includes/messages.php') ?>
        
        <form action="/usuarios/editar/<?= $user->id ?>" method="post" name="users" class="form col-md-6">
            <div class="form-group">
                <label for="first_name">Nome do usuário: *</label>
                <input type="text" name="first_name" value="<?= $user->first_name ?>" class="form-control" id="first_name" placeholder="Nome do usuário">
                <p class="message-js hide" data-message="first_name"></p>
            </div>
            
            <div class="form-group">
                <label for="last_name">Sobrenome do usuário: *</label>
                <input type="text" name="last_name" value="<?= $user->last_name ?>" class="form-control" id="last_name" placeholder="Sobrenome do usuário">
                <p class="message-js hide" data-message="last_name"></p>
            </div>
            
            <div class="form-group">
                <label for="group">Grupos (minímo 2 grupos): *</label>
                <p class="font-12">* Mantenha a tecla CTRL precionada para selecionar mais de um registro.</p>
                <select name="group_id[]" id="group" class="form-control" multiple>
                        <?php foreach ($groups as $group) : ?>
                            <?php if (in_array($group->id, $user->groups)) : ?>
                                <option value="<?= $group->id ?>" selected><?= $group->name ?></option>
                            <?php else : ?>
                                <option value="<?= $group->id ?>"><?= $group->name ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </select>
                <p class="message-js hide" data-message="group_id"></p>
            </div>
            
            <button class="btn btn-primary">Editar</button>
        </form>
    </div>
    
    <?php include(__DIR__ . '/../includes/footer.php') ?>
    <?php include(__DIR__ . '/../includes/scripts.php') ?>
    <script>
        start.form.users();
    </script>
</body>
</html>