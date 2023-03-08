<h1 style="margin-top: 20px;"> Haber Düzenle </h1> <br>
<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control"
               placeholder="Enter News Id"
               name="id" value="<?= $id ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Ara</button>
        </div>
    </div>
</form>

<?php if ($success): ?>
    <div class="alert alert-success">Haber Düzenlendi</div>
<?php endif; ?>

<?php if ($news): ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?> </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">

        <?php if ($news['poster_link']): ?>
            <img src="<?php echo $news['poster_link'] ?>" class="img"
                 style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
        <?php endif; ?>

        <div style="margin-top:10px;" class="form-group">
            <label>Resim</label>
            <input type="text" name="poster_link" class="form-control" value="<?php echo $news['poster_link'] ?>"></div>
        <div class="form-group">
            <label>Haber Başlığı</label>
            <input type="text" name="title" class="form-control" value="<?php echo $news['title'] ?>">
        </div>
        <div class="form-group">
            <label">Haber Detayı</label>
            <textarea class="form-control" name="details" rows="6"><?php echo $news['details'] ?></textarea>
        </div>
        <div class="container-1" style="display: flex; justify-content: center;">
            <button type="submit" class="btn btn-primary">Güncelle</button>

            <button style="margin-left: 7px;" type="submit"
                    onclick="return confirm('Haber Kalıcı Olarak Silinecektir. Onaylıyor musunuz?');" name="delete"
                    class="btn btn-danger">Sil
            </button>

        </div>
    </form>

<?php elseif ($warning): ?>
    <div style="font-size:large" class="alert alert-warning">Id ye göre haber düzenleyebilirsiniz <a
                href="/admin/news">Here </a></div>
<?php elseif (!$warning): ?>
    <div style="font-size:large" class="alert alert-warning">Haber bulunamadı
        <a href="/admin/news">Here </a></div>
<?php endif; ?>
</body>
</html>