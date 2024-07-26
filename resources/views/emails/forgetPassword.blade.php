<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-warning text-white text-center rounded-top">
                        <h2 class="my-2">Password Reset Request</h2>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title">Hello, 
                            @if($admin)
                                {{ $admin->name }}
                            @elseif($subadmin)
                                {{ $subadmin->name }}
                            @else
                                {{ $employee->name }}
                            @endif
                        !</h5>
                        <p class="card-text">
                            We received a request to reset your password. Use the token below to reset your password:
                        </p>
                        <div class="text-center mt-4">
                            <span class="badge bg-primary p-3">
                                @if($admin)
                                    {{ $admin_token }}
                                @elseif($subadmin)
                                    {{ $subadmin_token }}
                                @else
                                    {{ $employee_token }}
                                @endif
                            </span>
                        </div>
                        <p class="card-text mt-4">
                            If you did not request a password reset, please ignore this email or contact support if you have questions.
                        </p>
                        <p class="card-text">
                            Thanks,<br>
                            The Car Showroom Team
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
