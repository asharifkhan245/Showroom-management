<!DOCTYPE html>
<html>

<head>
    <title>Appointment Approved</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-success text-white text-center rounded-top">
                        <h2 class="my-2">Appointment Approved</h2>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title">Hello, {{ $name }}!</h5>
                        <p class="card-text">
                            We are pleased to inform you that your appointment has been approved.
                        </p>
                        <p class="card-text">
                            <strong>Appointment Date:</strong> {{ $appointment_date }}<br>
                            <strong>Appointment Time:</strong> {{ $appointment_time }}
                        </p>
                        <p class="card-text">
                            If you have any questions, feel free to contact us.
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Visit Our Website</a>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center rounded-bottom">
                        Thank you for choosing our services.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
