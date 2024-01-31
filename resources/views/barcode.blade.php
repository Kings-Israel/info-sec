<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor QR Code</title>
</head>
<body>
    {!! DNS2D::getBarcodeHTML((string) $guest->id, 'QRCODE') !!}
</body>
</html>
