<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<!-- Hotjar Tracking Code for Demo SDK PHP -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3324776,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ejemplos Webpay REST</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">

</head>

<body class="p-0 m-0">
   <div class="container min-h-screen mx-auto flex items-center justify-center">
       <div class="box shadow-lg p-10 bg-white" style="min-width: 50%;">
           <nav class="border-b w-full mb-5 py-1">
               <a class="text-gray-800 no-underline" href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a>
               @stack('nav')
           </nav>
        @yield('content')
       </div>
   </div>

</body>

</html>

