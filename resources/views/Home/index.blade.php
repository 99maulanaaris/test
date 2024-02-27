@extends('app')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <div class="d-flex justify-content-center align-items-center flex-column p-5">
                    <div>
                        <h6>{{ $user }}</h6>
                    </div>
                    <div class="ps-3">
                        <span class="text-success small pt-1 fw-bold">Pengguna Terdaftar</span>
                    </div>
                </div>
              </div>

            </div>
          </div>
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <div class="d-flex justify-content-center align-items-center flex-column p-5">
                    <div>
                        <h6>{{ $aktif }}</h6>
                    </div>
                    <div class="ps-3">
                        <span class="text-success small pt-1 fw-bold">PENGGUNA AKTIF</span>
                    </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div><!-- End Left side columns -->

    </div>
  </section>
@endsection
