<!DOCTYPE html>
<html>
<head>
    <title>Listagem de usuários - Teste Guep</title>
    <?php include(__DIR__ . '/../includes/head.php') ?>
</head>
<body>
    <?php include(__DIR__ . '/../includes/header.php') ?>
    
    <div class="container">
        <h3 class="title mg-20--bottom">Gerenciar <span class="font-16">usuários</span></h3>
        
        <?php include(__DIR__ . '/../includes/messages.php') ?>
        
        <div class="bg-primary pd-10"><?= $total ?> registro(s) encontrado(s)</div>
        
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Nome</td>
                        <td>Sobrenome</td>
                        <td>Grupos</td>
                        <td>Data de cadastro</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($users) : ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= $user->first_name ?></td>
                                <td><?= $user->last_name ?></td>
                                <td><?= implode($user->groups, ', ') ?></td>
                                <td><?= $user->created_at ?></td>
                                <td>
                                    <a href="/usuarios/editar/<?= $user->id ?>" class="btn btn-warning btn-small" title="Editar informações">
                                        Editar
                                    </a>
                                    <button data-href="/usuarios/excluir/<?= $user->id ?>" class="btn btn-danger btn-small destroy mg-6--vertical" data-toggle="modal" data-target=".modal-confirm" data-destroy="<?= $user->first_name ?>" title="Excluir grupo">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">
                                Nenhum registro encontrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($users) : ?>
            <?php include(__DIR__ . '/../includes/pagination.php') ?>
        <?php endif; ?>
    </div>
    
    <?php include(__DIR__ . '/../includes/modal-confirm.php') ?>
    <?php include(__DIR__ . '/../includes/footer.php') ?>
    <?php include(__DIR__ . '/../includes/scripts.php') ?>
</body>
</html>