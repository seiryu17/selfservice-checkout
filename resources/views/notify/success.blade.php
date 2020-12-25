<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Bless - Finished Checkout" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Bless - Finished Checkout</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/success.css')}}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="d-flex success-checkout align-items-center justify-content-center">
        <div class="col col-lg-4 text-center">
         <img src="{{url('images/success-buy.webp')}}" alt="" width="294">
            <h3 class="mt-4">
                Sukses Terbayar!
            </h3>
            <p class="mt-2">
                Invoice pembelian dapat di lihat pada email yang sudah anda daftarkan sebelumnya.
            </p>
            <a href="{{route('index')}}" class="primary-btn pd-cart mt-3">Back to Home</a>
        </div>
    </div>

    <!-- Js Plugins -->

</body>

</html>