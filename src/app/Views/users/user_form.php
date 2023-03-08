<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <label>Kullanıcı Adı</label>
            <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>"
                   placeholder="Kullanıcı Adı Giriniz" required>
        </div>
        <div class="form-group">
            <label>Şifre</label>
            <input type="password" class="form-control" name="password" placeholder="Şifre Giriniz" required>
        </div>
        <div class="form-group">
            <label>Şifre Tekrarı</label>
            <input type="password" class="form-control" name="password_confirm" placeholder="Tekrar Şifre Giriniz"
                   required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kayıt Ol</button>
</form>
</body>
</html>