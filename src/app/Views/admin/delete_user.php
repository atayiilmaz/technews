<h2>Kullanıcı Sil</h2>

<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control"
               placeholder="Enter User Id"
               name="id" value="<?= $id ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Ara</button>
        </div>
    </div>
</form>

<form action="" method="post" enctype="multipart/form-data">
    <button style="margin-top:15px;" type="submit" name="delete" class="btn btn-danger"
            onclick="return confirm('Hesap Kalıcı Olarak Silinecektir. Onaylıyor Musunuz?');">Sil
    </button>
    <br>
</form>
