<!doctype html>
<html lang="en">

    <?php include VIEWS_DIR . '/parts/head.php'; ?>

<body>

<div class="container mt-4 pt-4">

    <?php include VIEWS_DIR . '/parts/nav.php'; ?>

    <?php include VIEWS_DIR . '/parts/validation-errors.php'; ?>

    <div class="row">
        <div class="col">
            <h2>Add new task</h2>
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

    <?php include VIEWS_DIR . '/parts/footer-scripts.php'; ?>

</body>
</html>