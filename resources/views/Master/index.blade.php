@extends('app')


@section('content')
<div class="pagetitle">
    <h1>Master Pengguna</h1>
    <nav>
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
        <li class="breadcrumb-item active">Master Pengguna</li>
      </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="row">
        <div class="d-flex justify-content-start mb-3">
            <div class="btn btn-success" id="btn-add">
                <i class="bi bi-plus"></i>
                Tambah
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card info-card sales-card pt-3">
                <div class="card-body">
                    <table class="table" id="DataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
</section>

<div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('master.store') }}" class="needs-validation" novalidate method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="validationName" class="form-label">Nama Lengkap</label>
                        <input type="text" value="{{ old('fullname') }}" class="form-control" id="validationName" name="fullname" required>
                    </div>
                    <div class="col-md-12">
                        <label for="validationEmail" class="form-label">Email</label>
                        <input type="email" value="{{ old('email') }}" class="form-control" id="validationEmail" name="email" required>
                    </div>
                    <div class="col-md-12">
                        <label for="validationPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="validationPassword" name="password" required>
                    </div>
                    <div class="col-md-12">
                        <label for="validationKonfirmasi" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="validationKonfirmasi" name="password_confirmation" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('master.update') }}" class="needs-validation" novalidate method="POST">
            @csrf
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" value="{{ old('fullname') }}" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="text-danger fst-italic">* Input Jika Ingin Mengganti Password</span>
                    </div>
                    <div class="col-md-12">
                        <label for="confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirmation" name="password_confirmation">
                        <span class="text-danger fst-italic">* Input Jika Ingin Mengganti Password</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            let btnAdd      = $('#btn-add');
            let modal       = $('#modalInput');
            let modalEdit   = $('#modalEdit');

            btnAdd.on('click',function(){
                modal.modal('show');
            })

            let table = $('#DataTable').DataTable({
                paging: true,
                bLengthChange: false,
                ordering: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                oLanguage : {
                    sProcessing:
                            '<div class="dot-spinner">'+
                                '<div class="dot-spinner__dot"></div>'+
                                '<div class="dot-spinner__dot"></div>'+
                                '<div class="dot-spinner__dot"></div>'+
                                '<div class="dot-spinner__dot"></div>'+
                                '<div class="dot-spinner__dot"></div>'+
                                '<div class="dot-spinner__dot"></div>'+
                                '<div class="dot-spinner__dot"></div>'+
                                '<div class="dot-spinner__dot"></div>'+
                            '</div>',
                },
                ajax : {
                    url : `{{ route('master.index') }}`,
                    method : 'GET'
                },
                columns : [
                    { data : 'DT_RowIndex'},
                    { data : 'user_fullname', name : 'user_fullname'},
                    { data : 'user_email', name : 'user_email'},
                    { data : 'aksi'}
                ]
            })

            table.on('click','.btn-edit',function(){
                let data = table.row($(this).parents('tr')).data();
                modalEdit.find('#fullname').val(data.user_fullname);
                modalEdit.find('#email').val(data.user_email);
                modalEdit.find('#id').val(data.user_id);
                modalEdit.modal('show');
            })

            table.on('click','.btn-delete',function(){
                let data = table.row($(this).parents('tr')).data();
                Swal.fire({
                    title: "Apakah Anda Yakin?",
                    text: "Data, Akan Terhapus Secara Permanent",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yaa, Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url     : '{{ route('master.delete') }}',
                            method  : 'POST',
                            data : {
                                _token  : '{{ csrf_token() }}',
                                id      : data.user_id
                            }
                        }).then(result => {
                            if(result.status == 200){
                                alertToast('success',result.message)
                                table.ajax.reload();
                            }else{
                                alertToast('error',result.message)
                            }
                        })
                    }
                });
            })

            const alertToast = (icon, message) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: icon,
                    title: message
                })
            }
        })
    </script>
@endsection
