<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="container my-4">

    <?php if (!empty($_SESSION['flash']['validateErrors'])) : ?>
        <div class="row">
            <ul class="validate-errors__list">
                <?php foreach ($_SESSION['flash']['validateErrors'] as $error) : ?>
                    <li>
                        <?php echo $error; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col">
            <form method="post" action="/task/create">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="userEmail" id="inputEmail">
                </div>
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="userName" id="inputName">
                </div>
                <div class="mb-3">
                    <label for="taskDescription" class="form-label">Text</label>
                    <textarea class="form-control" name="taskDescription" id="taskDescription" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="/js/main.js" ></script>
</body>
</html>