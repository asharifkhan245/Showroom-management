<!DOCTYPE html>
<html>
<head>
    <style>
        .qr-code {
            display: inline-block;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        @foreach ($qrCodes as $qrCode)
            <div class="qr-code">
                <img src="{{ $qrCode }}" alt="QR Code">
            </div>
        @endforeach
    </div>
</body>
</html>
