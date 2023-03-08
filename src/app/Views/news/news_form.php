<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label>Resim</label>
        <input type="text" name="poster_link" class="form-control" value="<?php echo $news['poster_link'] ?>">
    </div>
    <div class="form-group">
        <label>Haber Başlığı</label>
        <input type="text" name="title" class="form-control" value="<?php echo $news['title'] ?>">
    </div>
    <div class="form-group">
        <label">Haber Detayı</label>
        <textarea class="form-control" name="details"><?php echo $news['details'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Ekle</button>
</form>
