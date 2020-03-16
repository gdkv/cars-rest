<?php echo $flashbag->display(); ?>
<div class="row">
    <?php if(count($cars)): ?>
        <?php foreach($cars as $car): ?>
            <div class="col-sm-6">
                <div class="card mb-5">
                    <div class="card-header"><small><?php echo $car['equipment'];?></small></div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $car['brand'];?>
                            <span class="badge badge-secondary">#<?php echo $car['id'];?></span>
                        </h5>
                        <h6><?php echo $car['model'];?></h6>
                        <p class="card-text">
                            <ul>
                            <?php foreach($car['specifications'] as $value): ?>
                                <li><?php echo $value; ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </p>
                        <?php /* if ($USER->isLoggedIn()): */?>
                            <a href="/admin/cars/edit/<?php echo $car['id']; ?>" class="card-link">Изменить</a>
                            <a href="/admin/cars/delete/<?php echo $car['id']; ?>" class="text-danger card-link">Удалить</a>
                        <?php /* endif; */?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Автомобилей нет, но можно <a href="/admin/cars/add/">добавить</a> 🚘🚙🚍</p>
    <?php endif;?>
</div>