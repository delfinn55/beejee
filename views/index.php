<?php
/** @var array $tasks */
/** @var int $taskCount */
/** @var int $limit */
?>

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

<div class="container">

    <div class="row my-4">
        <div class="col">
            <a href="/task/add">
                <button type="button" class="btn btn-secondary">Add task</button>
            </a>
        </div>
    </div>

    <div class="row my-4">
        <div class="col">
            <table id="tasks__list" class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Text</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>


                <?php foreach ($tasks as $task) : ?>

                    <tr class="tasks__item">
                        <th scope="row"><?php echo $task['id']; ?></th>
                        <td><?php echo $task['user_id']; ?></td>
                        <td><?php echo $task['description']; ?></td>
                        <td>
                            <?php if ($task['is_done']) : ?>
                                Done
                            <?php else : ?>
                                In progress
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-end">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="/?page=1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($pageIndex = 1; $pageIndex <= ceil($taskCount/$limit); $pageIndex++) : ?>

                    <li class="page-item">
                        <a class="page-link" href="/?page=<?php echo $pageIndex; ?>"><?php echo $pageIndex; ?></a>
                    </li>

                <?php endfor; ?>

                <li class="page-item">
                    <a class="page-link" href="/?page=<?php echo ceil($taskCount/$limit); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="/js/main.js" ></script>
</body>
</html>