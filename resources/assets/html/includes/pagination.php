<?php
    $page = (int) isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $page = ($page === 0) ? 1 : $page;
?>

<nav class="text-center" aria-label="Navegação">
    <ul class="pagination">
        <?php 
            $disabled = '';
            if ((int) $page === 1) {
                $disabled = 'disabled';
            }  
        ?>
        <li class="<?= $disabled ?>">
            <a href="<?= url()->current() ?>?pagina=1" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        
        <?php for ($i = 0; $i < $count_pages; $i++) : ?>
            <?php 
                $active = '';
                if ((int) $page - 1 === $i) {
                    $active = 'active';
                }  
            ?>
            <li class="<?= $active ?>"><a href="<?= url()->current() ?>?pagina=<?= $i + 1 ?>"><?= $i + 1 ?></a></li>
        <?php endfor; ?>
        
        <?php 
            $disabled = '';
            if ((int) $page === $count_pages) {
                $disabled = 'disabled';
            }  
        ?>
        <li class="<?= $disabled ?>">
            <a href="<?= url()->current() ?>?pagina=<?= $count_pages ?>" aria-label="Próxima">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>