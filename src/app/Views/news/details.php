<div class="box">
    <h1 style="margin-top:15px; text-align: center"> <?= $news['title']; ?> </h1>
    <img src="<?= $news['poster_link']; ?>" alt="" class="img"
         style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
    <p>
        <?= $news['details']; ?>
    </p>
</div>

<h2 style="margin-top: 25px; text-align: center;">Yorumlar</h2>
<hr>
<?php
if ($comments):
    foreach ($comments as $i => $comment): ?>
        <h4 style="text-align: center;">
            <?php echo $comment['cusername']; ?>
        </h4>
        <p style="text-align: center;"><?= $comment['comment'] ?></p>
        <p style="text-align: center;"><?= $comment['date'] ?></p>
    <?php endforeach;

else: ?>
    <p style="text-align: center;"> Yorum Yok.. </p>
<?php endif; ?>


<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['username'])): ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <textarea class="form-control" name="comment" id=""
                      rows="10"><?php echo $add_comments['comment']; ?></textarea>
            <br>
            <button type="submit" class="btn btn-info">Gönder</button>
    </form>
<?php else: ?>
    <p style="text-align: center;">Yorum atabilmek için <a href="/users/login">Giriş Yap</a></p>

<?php endif; ?>

