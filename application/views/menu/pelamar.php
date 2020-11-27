<div class="container-fluid">
  <h2>Data Pelamar</h2>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Tempat Tinggal</th>
        <th>Besar Gaji</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?> <?php foreach ($pendaftaran as $daftar) : ?>
        <tr>
          <td><?= $i; ?></td>
          <td><?= $daftar['nama']; ?></td>
          <td><?= $daftar['J_kelamin']; ?></td>
          <td><?= $daftar['alamat_tinggal']; ?></td>
          <td><?= $daftar['penghasilan']; ?></td>
          <td>
            <a href="detail/<?= $daftar['id'] ?>" class="btn btn-primary">Detail</a>
          </td>
        </tr>
        <?php $i++; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>