<?php
/** @var array $tasks */
/** @var int $taskCount */
/** @var int $limit */
/** @var array $order */
?>

<!doctype html>
<html lang="en">

    <?php include VIEWS_DIR . '/parts/head.php'; ?>

<body>

<div class="container mt-4 pt-4">

    <?php include VIEWS_DIR . '/parts/nav.php'; ?>

    <?php include VIEWS_DIR . '/parts/validation-errors.php'; ?>

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
        <div class="col-10">
            Sort by:
            <ul>
                <li>
                    Name <a href="/?order_by=name&order_dir=asc">[a-z]</a><a href="/?order_by=name&order_dir=desc">[z-a]</a>
                </li>
                <li>
                    Email <a href="/?order_by=email&order_dir=asc">[a-z]</a><a href="/?order_by=email&order_dir=desc">[z-a]</a>
                </li>
                <li>
                    Status <a href="/?order_by=status&order_dir=asc">[x]</a><a href="/?order_by=status&order_dir=desc">[v]</a>
                </li>
            </ul>
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
                    <th scope="col">Status</th>

                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin']) : ?>
                        <th scope="col">Actions</th>
                    <?php endif; ?>
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

                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin']) : ?>
                            <td>
                                <a href="/task/edit/?id=<?php echo $task['id']; ?>">[Edit]</a>
                            </td>
                        <?php endif; ?>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-end">
            <ul class="pagination">

                <?php
                    $orderSegment = (isset($order['order_by'])) ? "order_by={$order['order_by']}&" : '';
                    $orderSegment .= (isset($order['order_dir'])) ? "order_dir={$order['order_dir']}&" : '';
                ?>

                <li class="page-item">
                    <a class="page-link" href="/?<?php echo $orderSegment; ?>page=1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($pageIndex = 1; $pageIndex <= ceil($taskCount/$limit); $pageIndex++) : ?>

                    <li class="page-item">
                        <a class="page-link" href="/?<?php echo $orderSegment; ?>page=<?php echo $pageIndex; ?>"><?php echo $pageIndex; ?></a>
                    </li>

                <?php endfor; ?>

                <li class="page-item">
                    <a class="page-link" href="/?<?php echo $orderSegment; ?>page=<?php echo ceil($taskCount/$limit); ?>" aria-label="Next">
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