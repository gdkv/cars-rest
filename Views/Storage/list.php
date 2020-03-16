<?php echo $flashbag->display(); ?>
<div class="row">
    <?php if(count($storages)): ?>
        <?php foreach($storages as $storage): ?>
            <div class="col-sm-6">
                <div class="card mb-5">
                    <div class="card-header"><small><?php echo $storage['status'];?></small></div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="badge badge-secondary">#<?php echo $storage['id'];?></span>
                        </h5>
                        <h6><?php echo $storage['car']['brand'];?> <?php echo $storage['car']['model']; ?></h6>
                        <p class="card-text">
                            Кол-во: <?php echo $storage['count'];?>
                        </p>
                        <?php /* if ($USER->isLoggedIn()): */?>
                            <a href="/admin/storage/edit/<?php echo $storage['id']; ?>" class="card-link">Изменить</a>
                            <a href="/admin/storage/delete/<?php echo $storage['id']; ?>" class="text-danger card-link">Удалить</a>
                        <?php /* endif; */?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Состояний склада нет, но можно <a href="/admin/storage/add/">добавить</a> 🚘🚙🚍</p>
    <?php endif;?>
</div>