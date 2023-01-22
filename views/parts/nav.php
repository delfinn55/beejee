<nav class="navbar navbar-expand">
    <div class="container-fluid">
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" aria-current="page" href="/">->Home</a>
                <a class="nav-link" aria-current="page" href="/task/add">->Add task</a>
                <?php if (isset($_SESSION['user'])) : ?>
                    <form method="post" action="/user/logout">
                        <button type="submit" class="nav-link btn btn-link">->Logout</button>
                    </form>
                <?php else : ?>
                    <a class="nav-link" aria-current="page" href="/user/login">->Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>