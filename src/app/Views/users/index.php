<?php if ($user['userGroup'] == 'Admin'): ?>
    <h1 style="text-align:center; margin-top: 20px;">Hoş Geldin, <?= $user['username']; ?></h1>
    <br> <br>
    <a href="/admin">
        <div class="btn btn-danger"
             style="display: flex; justify-content: center; margin-left: 600px; margin-right: 600px;">Admin Panel
        </div>
    </a>
    <br><br>
    <p style="text-align: center;">Your Token:</p>
    <textarea name="" id="" rows="3" cols="167"
              style="text-align: center; display: flex; justify-content: center;"> <?= $token['token']; ?>
</textarea>
    <p style="text-align: center;">Expires at: <?= $token['expires']; ?> </p>

<?php else: ?>
    <h1 style="text-align: center; margin-top: 20px;">Hoş Geldin, <?= $user['username']; ?></h1>
    <hr> <br> <br>
<?php endif; ?>

<?php if ($user['userGroup'] == 'Standard User'): ?>
    <form method="post">
        <h2 style="text-align: center;"> Hesabı Kapat
            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure?');">Sil
            </button>
        </h2>
    </form>
    <br><br>
    <p style="text-align: center;">Your Token:</p>
    <textarea name="" id="" rows="3" cols="167"
              style="text-align: center; display: flex; justify-content: center;"> <?= $token['token']; ?>
</textarea>
    <p style="text-align: center;">Expires at: <?= $token['expires']; ?> </p>


<?php endif; ?>