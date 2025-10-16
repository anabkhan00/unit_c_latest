<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>UnitC - Registration</title>
</head>

<body>

  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>UnitC - Registration</title>
     <style>
    .imgbac{
        background: url('./images/Frame\ 1.svg') no-repeat center center;
        background-size: cover;
    }
    .coma{
        height: 20px;
        width: 20px;
    }
    .marginfor{
        margin-top: 90px;
    }
    .leftpara{
        color: white;

    }
    .buton1{
        width: 100%;
        background-color: #1565D8;
        color: white;
        border: none;
        font-size: 14px;
        padding :15px 10px;
        font-weight: 500;
        border-radius: 5px;
    }
    .buton1:hover{
        background-color: white;
        color:  #1565D8;
        border:1px solid #1565D8;
    }
    .buton:hover{
        background-color: #1565D8;
        color:  white;
        border:1px solid #1565D8;
    }
    .buton{
        width: 100%;
        background-color: white;
        color: #0C5097;
        border: none;
        font-size: 14px;
        padding :15px 10px;
        font-weight: 500;
        border-radius: 5px;
    }
    .rightpara{
color: #8692A6;
font-size: 12px;
    }
    label{
        color: #696F79;
        font-weight: 600;
        font-size: 14px;
    }
    .form-control {
    display: block;
    width: 100%;
    padding: .500rem .75rem;
    font-size:16px;
    font-weight: 400;
    line-height: 1.5;
    color: #8692A6;
    background-color: var(--bs-body-bg);
    background-clip: padding-box;
    border: var(--bs-border-width) solid #8692A6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
.form-control::placeholder {
    color: #8692A6;

}
.form-select {
    --bs-form-select-bg-img: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e);
    display: block;
    width: 100%;
    padding: .500rem 2.25rem .500rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #8692A6;
    background-color: var(--bs-body-bg);
    background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
    background-repeat: no-repeat;
    background-position: right .75rem center;
    background-size: 16px 12px;
    border: var(--bs-border-width) solid #8692A6;
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.or-divider {
            display: flex;
            align-items: center;
            text-align: center;
        }
        .or-divider::before,
        .or-divider::after {
            content: "";
            flex: 1;
            border-top: 2px solid black;
            margin: 0 10px;
        }
        .or-text {
            color: gray;
            font-size: 14px;
        }
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 10px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px 10px;
            font-size: 16px;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: 100%;
    }
        .google-btn:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .google-icon {
            width: 24px;
            height: 24px;
        }
        .password-wrapper i {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #999;
}

.password-wrapper i:hover {
  color: #000;
}

 </style>
</head>

<body style="background-color:white;">


   <div class="container-fluid">
    <div class="row">
        <div class="col-md-4 imgbac p-5">
            <img src= "{{ asset('images/Vector (2).svg') }}" class="img-fluid w-25" alt="...">
            <div class="row">
                <div class="col-12 marginfor">
                    <img src="./images/“.svg" class="coma mb-3"  alt="...">
                    <p class="leftpara">The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.</p>
                <p class="leftpara">Hassan</p>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <img src="./images/Vector 1.svg" class="coma mb-3"  alt="...">
                </div>
                <div class="col-12 mt-3">
                        <a href="{{ route('login.form') }}" style="text-decoration: none">
<button class="buton">Already have an account, Login</button>
</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 my-3">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                   <div class="row">
                    <div class="col-md-9">
                           <form action="{{ route('register.store') }}" method="POST">
                                        @csrf
                        <h4><strong>Register  Account!</strong></h4>
                        <p class="rightpara m-0">For the purpose of industry regulation, your details are required.</p>
                        <label class="my-2">Register as a </label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                        <option value="1">CEO</option>
                                            <option value="2">Finance</option>
                                            <option value="3">Admin</option>
                          </select>
                          <label class="my-2">Name</label>
                          <input type="text" class="form-control" name="name"
                                                placeholder="Name" value="{{ old('name') }}"
                                                oninput="this.value=this.value.replace(/[^a-zA-Z\s]/g, '')">
                                                  @error('name')
                                                <div class="text-danger" style="margin-left: 85px; font-size:12px">
                                                    {{ $message }}</div>
                                            @enderror
                          <label class="my-2">Email</label>
                          <input type="email" name="email" class="form-control"  placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                                <div class="text-danger" style="margin-left: 85px; font-size:12px">
                                                    {{ $message }}</div>
                                            @enderror
                          <label class="my-2">Phone Number</label>
                          <input type="tel" name="phone_num" class="form-control"  placeholder="Phone No" value="{{ old('phone_num') }}"
                                                oninput="this.value=this.value.replace(/\D/g, '')" maxlength="13">
                                                   @error('phone_num')
                                                <div class="text-danger" style="margin-left: 85px; font-size:12px">
                                                    {{ $message }}</div>
                                            @enderror
                       <!-- Password Field -->
<label class="my-2">Password</label>
<div class="password-wrapper" style="position: relative;">
  <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Password">
  <i id="togglePassword" class="fa fa-eye"></i>
</div>      @error('password')
                                                <div class="text-danger" style="margin-left: 85px; font-size:12px">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                      <label class="my-2">Confirm Password</label>
<div class="password-wrapper" style="position: relative;">
  <input type="password" name="password_confirmation" id="confirmPasswordInput" class="form-control" placeholder="Confirm Password">
  <i id="toggleConfirmPassword" class="fa fa-eye"></i>
</div>    @error('password_confirmation')
                                                <div class="text-danger" style="margin-left: 85px; font-size:12px">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                          <button class="buton1 mt-2" id="registerBtn" text="Register">Register Account</button>
                                 </form>
                          <div class="or-divider mt-2">
                            <span class="or-text">Or</span>
                            <span class="blue-line"></span>
                        </div>
                          <a href="{{ route('auth.provider', 'google') }}" style="text-decoration: none">
                        <button class="google-btn">
                            <img src="./images/flat-color-icons_google.svg" alt="Google Icon" class="google-icon ms-5 me-5">
                            Register with Google
                        </button>
                        </a>
                         <a href="{{ route('auth.provider', 'slack') }}" style="text-decoration: none">
                        <button class="google-btn mt-2">
                            <img src="./images/Group.svg" alt="Google Icon" class="google-icon ms-5 me-5">
                            Register with Slack
                        </button> </a>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>






        <script src="{{ asset('js/common.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#togglePassword').on('click', function () {
    const input = $('#passwordInput');
    const type = input.attr('type') === 'password' ? 'text' : 'password';
    input.attr('type', type);
    $(this).toggleClass('fa-eye fa-eye-slash');
  });

  $('#toggleConfirmPassword').on('click', function () {
    const input = $('#confirmPasswordInput');
    const type = input.attr('type') === 'password' ? 'text' : 'password';
    input.attr('type', type);
    $(this).toggleClass('fa-eye fa-eye-slash');
  });
</script>

    </body>

</html>

  
