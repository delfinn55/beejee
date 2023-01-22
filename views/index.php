<?php
/** @var array $tasks */
/** @var int $taskCount */
/** @var int $limit */
?>

<!doctype html>
<html lang="en">

    <?php include VIEWS_DIR . '/parts/head.php'; ?>

<body>

<div class="container mt-4 pt-4">

    <?php include VIEWS_DIR . '/parts/nav.php'; ?>

    <?php if (!empty($_SESSION['flash']['successMessages'])) : ?>
        <div class="row">
            <ul class="success-messages__list">
                <?php foreach ($_SESSION['flash']['successMessages'] as $message) : ?>
                    <li>
                        <?php echo $message; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>

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
                    <th scope="col">Email</th>
                    <th scope="col">Text</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>


                <?php foreach ($tasks as $task) : ?>

                    <tr class="tasks__item">
                        <th scope="row"><?php echo $task['id']; ?></th>
                        <td><?php echo $task['user_name']; ?></td>
                        <td><?php echo $task['user_email']; ?></td>
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

    <?php include VIEWS_DIR . '/parts/footer-scripts.php'; ?>

</body>
</html>