<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control"
               placeholder="Search for News"
               name="search" value="<?= $search ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Ara</button>
        </div>
    </div>
</form>

<?php if ($news): foreach ($news as $i => $new): ?>

    <img src="<?= $new['poster_link']; ?>" style="display: block; margin-left: auto; margin-right: auto; width: 50%;"
         class="thumb-img">
    <a href="/news/details?id=<?php echo $new['id'] ?>" style="text-align: center"><h2><?php echo $new['title'] ?></h2>
    </a>
<?php endforeach;
else: ?> <p>Haber Bulunamadı</p>
<?php endif; ?>