<div class="container-fluid">
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Tempat Tinggal</th>
        <th>Besar Gaji</th>
        <th>Status</th>
        <th>Agama</th>
        <th>No Telp</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?> <?php foreach ($details as $detail) : ?>
        <tr>
          <td><?= $i; ?></td>
          <td><?= $detail['nama']; ?></td>
          <td><?= $detail['J_kelamin']; ?></td>
          <td><?= $detail['alamat_tinggal']; ?></td>
          <td><?= $detail['penghasilan']; ?></td>
          <td><?= $detail['status']; ?></td>
          <td><?= $detail['agama']; ?></td>
          <td><?= $detail['no_telp']; ?></td>
          <td><?= $detail['email']; ?></td>

        </tr>
        <?php $i++; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>