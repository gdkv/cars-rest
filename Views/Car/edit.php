<h1>Изменить авто</h1>
<?php if($errors): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errors; ?>
    </div>
<?php endif; ?>
<form method='post' action='/cars/edit'>
    <input type="hidden" value="<?php echo $car['id'];?>" name="id" />
    <div class="form-group">
        <input type="text" class="form-control" id="brand" placeholder="Введите марку авто" name="brand" value="<?php echo $car["brand"];?>" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="model" placeholder="Введите модель авто" name="model" value="<?php echo $car["model"];?>"  required>
    </div>
    <div class="form-group">
        <input type="number" class="form-control" id="year" placeholder="Введите год авто" name="year" value="<?php echo $car["year"];?>" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="equipment" placeholder="Введите комплектацию авто" name="equipment" value="<?php echo $car["equipment"];?>" required>
    </div>
    <div class="form-group">
        <label for="specifications">JSON характеристики {}</label>
        <textarea class="form-control" id="specifications" placeholder="" name="specifications" rows="3"><?php echo $car["specifications"];?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Изменить</button>
</form>