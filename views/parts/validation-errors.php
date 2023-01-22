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