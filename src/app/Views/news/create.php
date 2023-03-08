<?php if ($_SESSION['userGroup'] == 'Admin'): ?>
<?php endif; ?>
    <h1> Haber Ekle </h1>
<?php if ($success): ?>
    <div class="alert alert-success">
        Haber Eklendi!
    </div>
<?php endif; ?>
<?php include_once "news_form.php" ?>