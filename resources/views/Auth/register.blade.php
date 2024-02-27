<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="register-container">
    <div class="register-box">
      <h2>Register</h2>
      <form action="{{ route('create-user') }}" method="POST">
        @csrf
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" name="fullname" id="fullname" placeholder="Full Name" required>
        </div>
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="capcha-group">
            <div class="input-group">
                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
            </div>
            <div class="input-group">
                <div class="captcha">
                    <span>{!! captcha_img() !!}</span>
                    <div class="btn-capcha" id="reload">
                        &#x21bb;
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn">Register</button>
      </form>
      <div class="additional-links">
        <p>Already have an account? <a href="{{ route('login') }}">Login here</a>.</p>
      </div>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.js"></script>
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '{{ route('reload-captcha') }}',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@if (session()->has('success'))
<script>
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
        icon: 'success',
        title: '{{ session()->get('success') }}'
    })
</script>
@endif
@if (session()->has('errors'))
  <script>
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
            icon: 'error',
            title: '{{ session()->get('errors') }}'
        })
    </script>
@endif
</html>
