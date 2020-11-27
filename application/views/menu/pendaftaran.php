<div class="container-fluid">
  <h2 class="text-center">Data Pribadi Pelamar</h2>

  <form method="POST" action="<?= base_url('user/pendaftaran'); ?>">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">POSIS YANG DILAMAR</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputEmail3" name="p_lamar">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputEmail3" name="nama">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">NO. KTP</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="no_ktp">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">TEMPAT TANGGAL LAHIR</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="tmp_lahir">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">JENIS KELAMIN</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="j_kelamnin">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">AGAMA</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="agama">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">GOLONGAN DARAH</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="g_darah">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">STATUS</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="status">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">ALAMAT KTP</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="alamat_ktp">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">ALAMAT TINGGAL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="alamat_tinggal">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">EMAIL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="email">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">NO. TELP</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="no_telp">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">ORANG TERDEKAT YANG DAPAT DIHUBUNGI</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="org_deket">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">SKILL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="skill">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">BERSEDIA DI TEMPATKAN DI SELURUH KANTOR PERUSAHAAN</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="tmp_perusahaan">
      </div>
    </div>


    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">PENGHASILAN YANG DIHARAPKAN</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword3" name="penghasilan">
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block">
      Save
    </button>

  </form>

</div>