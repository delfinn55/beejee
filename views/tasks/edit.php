<?php /** @var Task $taskItem */ ?>

<!doctype html>
<html lang="en">

    <?php include VIEWS_DIR . '/parts/head.php'; ?>

<body>

<div class="container mt-4 pt-4">

    <?php include VIEWS_DIR . '/parts/nav.php'; ?>

    <?php include VIEWS_DIR . '/parts/validation-errors.php'; ?>

    <div class="row">
        <div class="col">
            <h2>Edit task #<?php echo $taskItem['id']; ?></h2>
            <form method="post" action="/task/update">
                <div class="mb-3">
                    <label for="taskDescription" class="form-label">Text</label>
                    <textarea class="form-control" name="taskDescription" id="taskDescription" rows="3"><?php echo $taskItem['description']; ?></textarea>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="taskIsDone" id="taskIsDone" <?php if ($taskItem['is_done']) echo 'checked'; ?>>
                    <label class="form-check-label" for="taskIsDone">
                        Is done
                    </label>
                </div>
                <input type="hidden" name="taskId" value="<?php echo $taskItem['id'] ?>">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>

</div>

    <?php include VIEWS_DIR . '/parts/footer-scripts.php'; ?>

</body>
</html>