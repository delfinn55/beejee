<!doctype html>
<html lang="en">

    <?php include VIEWS_DIR . '/parts/head.php'; ?>

<body>

<div class="container mt-4 pt-4">

    <?php include VIEWS_DIR . '/parts/nav.php'; ?>

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
            <form method="post" action="/user/login">
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" name="userName" id="inputName">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="text" class="form-control" name="userPassword" id="inputPassword">
                </div>
                <button type="submit" class="btn btn-secondary">Login</button>
            </form>
        </div>
    </div>

</div>

    <?php include VIEWS_DIR . '/parts/footer-scripts.php'; ?>

</body>
</html>