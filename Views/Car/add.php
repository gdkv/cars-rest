<h1>Добавить авто</h1>
<?php if($errors): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errors; ?>
    </div>
<?php endif; ?>
<form method='post' action='/cars/add'>
    <div class="form-group">
        <input type="text" class="form-control" id="brand" placeholder="Введите марку авто" name="brand" value="" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="model" placeholder="Введите модель авто" name="model" required>
    </div>
    <div class="form-group">
        <input type="number" class="form-control" id="year" placeholder="Введите год авто" name="year" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="equipment" placeholder="Введите комплектацию авто" name="equipment" required>
    </div>
    <div class="form-group">
        <label for="specifications">JSON характеристики {}</label>
        <textarea class="form-control" id="specifications" placeholder="" name="specifications" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>