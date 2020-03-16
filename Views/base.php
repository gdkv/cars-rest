<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚘</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark p-1">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/admin/cars/list">Car REST API</a>
        <div class="w-25 order-1 order-md-0">
            <ul class="nav navbar-nav">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="/admin/cars/list">Машины</a>
                </li>
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="/admin/storage/list">Склады</a>
                </li>
            </ul>
        </div> 
        <div class="w-100 order-1 order-md-0">
            <ul class="nav nav-pills">
                <li class="nav-item text-nowrap mr-2">
                    <a class="nav-link active" href="/admin/cars/add">Добавить машину</a>
                </li>
                <li class="nav-item text-nowrap">
                    <a class="nav-link active" href="/admin/storage/add">Добавить состояние склада</a>
                </li>
            </ul>
        </div> 
        <div class="order-2 order-md-1">
            <ul class="navbar-nav px-3">
                <?php if($user): ?>
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="/admin/logout">Выход</a>
                </li>
                <li class="nav-item text-nowrap">
                    <a class="nav-link disabled"><?php echo $user['login']; ?></a>
                </li>
                <?php else: ?>
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="/admin/login">Войти</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <main role="main" class="container mt-5 mb-5">
        <?php
            echo $content;
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('form').on('submit', function(event){
                event.preventDefault();
                var t = $(this);
                var formData = JSON.stringify({"formData": t.serializeArray()});
                $.ajax({
                    type: "POST",
                    url: t.attr('action'),
                    data: formData,
                    success: function(data){
                        if(data.status){
                            window.location = "/admin/cars/list";
                        }
                    },
                    dataType: "json",
                    contentType : "application/json"
                });
            });
            
        });
    </script>
</body>
</html>