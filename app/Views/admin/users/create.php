<?= $this->include('admin/partials/header') ?> 

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h3>Tambah Pengguna untuk Sekolah: <?= $school_id ?></h3>

        <!-- Form Create User -->
        <form action="<?= base_url('admin/users/store') ?>" method="post">
          
          <!-- Hidden input untuk school_id -->
          <input type="hidden" name="school_id" value="<?= $school_id ?>">

          <!-- Username -->
          <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>

          <!-- Email -->
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <!-- Password -->
          <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <!-- Role -->
          <div class="form-group mb-3">
            <label for="role">Peran</label>
            <select name="role" class="form-control">
              <option value="admin">Admin</option>
              <option value="operator">Operator</option>
              <option value="user">User</option>
            </select>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->include('admin/partials/footer') ?>
