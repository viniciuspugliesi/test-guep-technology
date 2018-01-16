<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar grupos - Teste Guep</title>
    <?php include(__DIR__ . '/../includes/head.php') ?>
</head>
<body>
    <?php include(__DIR__ . '/../includes/header.php') ?>
    
    <div class="container">
        <h3 class="title mg-20--bottom">Gerenciar <span class="font-16">grupos</span></h3>
        
        <?php include(__DIR__ . '/../includes/messages.php') ?>
        
        <div class="bg-primary pd-10"><?= $total ?> registro(s) encontrado(s)</div>
        
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Nome</td>
                        <td>Data de cadastro</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($groups) : ?>
                        <?php foreach ($groups as $group) : ?>
                            <tr>
                                <td><?= $group->id ?></td>
                                <td><?= $group->name ?></td>
                                <td><?= $group->created_at ?></td>
                                <td>
                                    <a href="/grupos/editar/<?= $group->id ?>" class="btn btn-warning btn-small" title="Editar informações">
                                        Editar
                                    </a>
                                    <button data-href="/grupos/excluir/<?= $group->id ?>" class="btn btn-danger btn-small destroy mg-6--vertical" data-toggle="modal" data-target=".modal-confirm" data-destroy="<?= $group->name ?>" title="Excluir grupo">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">
                                Nenhum registro encontrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($groups) : ?>
            <?php include(__DIR__ . '/../includes/pagination.php') ?>
        <?php endif; ?>
    </div>
    
    <?php include(__DIR__ . '/../includes/modal-confirm.php') ?>
    <?php include(__DIR__ . '/../includes/footer.php') ?>
    <?php include(__DIR__ . '/../includes/scripts.php') ?>
</body>
</html>