<h1 style="margin-top: 20px;">Haber Listesi</h1>

<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control"
               placeholder="Haber Ara"
               name="search" value="<?= $search ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Ara</button>
        </div>
    </div>
</form>

<p>
    <a href="/admin/createnews" class="btn btn-primary">Haber Ekle</a>
</p>

<table class="table">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Details</th>
        <th scope="col">Action</th>
    </tr>
    <tbody>

    <?php if ($news): foreach ($news as $i => $new): ?>
        <tr>
            <td><?= $new['id'] ?></td>
            <td><a href="/news/details?id=<?= $new['id']; ?>"><?= $new['title'] ?></a></td>
            <td><?= $new['details'] ?></td>

            <td>
                <a href="/admin/editnews?id=<?php echo $new['id'] ?>" button type="button" class="btn btn-primary">Güncelle/Sil</a>
            </td>
        </tr>
    <?php endforeach;
    else: ?> <p>Haber Bulunamadı</p>
    <?php endif; ?>
    </tbody>
</table>