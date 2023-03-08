<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="" method="POST" class="was-validated">
    <div class="form-group">
        <label>Kullanıcı Adı</label>
        <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>"
               placeholder="Kullanıcı adınızı giriniz" required>
        <div class="valid-feedback">Uygun</div>
        <div class="invalid-feedback">Lütfen bu alanı doldurunuz.</div>
    </div>
    <div class="form-group">
        <label for="pwd">Şifre:</label>
        <input type="password" class="form-control" id="password" placeholder="Şifre Giriniz" name="password" required>
        <div class="valid-feedback">Uygun</div>
        <div class="invalid-feedback">Lütfen bu alanı doldurunuz.</div>
    </div>
    <button type="submit" name="btn" class="btn btn-primary">Giriş Yap</button>
    <p class="text1">Hesabın yok mu? <a href="/users/register">Kayıt Ol</a></p>
</form>

</body>
</html>