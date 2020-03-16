<h1>Добавить склад</h1>
<?php if($errors): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errors; ?>
    </div>
<?php endif; ?>
<form method='post' action='/storage/add'>
    <div class="form-group">
        <select class="form-control" name="car">
            <?php foreach($cars as $car): ?>
                <option value="<?php echo $car['id'];?>"><?php echo $car['brand'];?> <?php echo $car['model'];?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="status">
            <?php foreach($status as $item): ?>
                <option value="<?php echo $item['id'];?>"><?php echo $item['title'];?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <input type="number" class="form-control" id="count" placeholder="Количество" name="count" required>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>