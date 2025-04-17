<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h3>Edit Pengguna: <?= $user['username'] ?></h3>
        <!-- Perbaiki action form agar mengarah ke rute update -->
        <form action="<?= base_url('admin/users/update/' . $user['id']) ?>" method="post">
          <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
          </div>
          <div class="form-group mb-3">
            <label for="password">Password (opsional)</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="role">Peran</label>
            <select name="role" class="form-control">
              <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
              <option value="operator" <?= $user['role'] === 'operator' ? 'selected' : '' ?>>Operator</option>
              <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update Pengguna</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->include('admin/partials/footer') ?>
