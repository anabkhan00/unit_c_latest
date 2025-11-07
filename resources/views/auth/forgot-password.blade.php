<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <title>UnitC - Forget Password</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .imgbac {
            background: url('./images/Frame 1.svg') no-repeat center center;
            background-size: cover;
            height: 100vh;
        }
        .coma { height: 20px; width: 20px; }
        .marginfor { margin-top: 90px; }
        .leftpara { color: white; }
        .buton1 {
            width: 100%;
            background-color: #1565D8;
            color: white;
            border: none;
            font-size: 14px;
            padding: 15px 10px;
            font-weight: 500;
            border-radius: 5px;
        }
        .buton1:hover {
            background-color: white;
            color: #1565D8;
            border: 1px solid #1565D8;
        }
        .buton:hover {
            background-color: #1565D8;
            color: white;
            border: 1px solid #1565D8;
        }
        .buton {
            width: 100%;
            background-color: white;
            color: #0C5097;
            border: none;
            font-size: 14px;
            padding: 15px 10px;
            font-weight: 500;
            border-radius: 5px;
        }
        .rightpara { color: #8692A6; font-size: 12px; }
        label { color: #696F79; font-weight: 600; font-size: 14px; }
        .form-control {
            display: block;
            width: 100%;
            padding: .5rem .75rem;
            font-size: 16px;
            color: #8692A6;
            border: 1px solid #8692A6;
            border-radius: 5px;
        }
        .form-control::placeholder { color: #8692A6; }
        .marginlogin { margin: 200px 0px; }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 imgbac p-5">
                <img src="./images/Vector (2).svg" class="img-fluid w-25" alt="...">
                <div class="row">
                    <div class="col-12 marginfor">
                        <img src="./images/“.svg" class="coma mb-3" alt="...">
                        <p class="leftpara">
                            The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.
                        </p>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <img src="./images/Vector 1.svg" class="coma mb-3" alt="...">
                    </div>
                </div>
            </div>

            <div class="col-md-8 marginlogin">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-9">
                                <h4><strong>Forget Password</strong></h4>
                                <p class="rightpara m-0">Enter your registered email address to continue using Unit C.</p>

                                <form id="forgetPasswordForm">
                                    @csrf
                                    <label class="my-2">Email address*</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Registered Email">
                                    <div id="emailError" class="text-danger" style="font-size:12px;"></div>

                                    <button type="submit" class="buton1 mt-5" id="resetPasswordBtn">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {

        $('#forgetPasswordForm').on('submit', function(e) {
            e.preventDefault();

            $('#emailError').text('');
            var formData = {
                email: $('#email').val(),
                _token: '{{ csrf_token() }}'
            };

            $('#resetPasswordBtn').prop('disabled', true).text('Please wait...');

            $.ajax({
                url: "{{ route('password.email') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    $('#resetPasswordBtn').prop('disabled', false).text('Submit');
                    $('#forgetPasswordForm')[0].reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'A password reset link has been sent to your email.',
                        confirmButtonColor: '#1565D8'
                    });
                },
                error: function(xhr) {
                    $('#resetPasswordBtn').prop('disabled', false).text('Submit');

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.email) {
                            $('#emailError').text(errors.email[0]);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errors.email ? errors.email[0] : 'Please check your input.',
                            confirmButtonColor: '#d33'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonColor: '#d33'
                        });
                    }
                }
            });
        });

    });
    </script>

</body>
</html>
