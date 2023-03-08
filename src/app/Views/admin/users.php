<h1>Kullanıcı Listesi</h1>

<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control"
               placeholder="Search for Users with Username"
               name="search" value="<?= $search ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Ara</button>
        </div>
    </div>
</form>

<table class="table">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th scope="col">User Group</th>
        <th scope="col">Action</th>
    </tr>
    <tbody>

    <?php if ($users):
        foreach ($users as $i => $user): ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['userGroup'] ?></td>
                <td>
                    <a href="/admin/delete_user?id=<?php echo $user['id'] ?>" button type="button"
                       class="btn btn-primary">Sil</a>
                </td>
            </tr>
        <?php endforeach;
    else: ?> <p>Kullanıcı bulunamadı</p>
    <?php endif; ?>
    </tbody>
</table>