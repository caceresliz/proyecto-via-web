<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>DualSupport</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}"/>

    @include('layouts.theme.style')
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        
            
    </nav>

    <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <br>
                <hr>
                <hr>
                <h1 class="display-3">Inter Satelital Support</h1>
                <pre>Ínter Satelital Es Televisión Prepago HD Para todo Bolivia. Esta empresa está regulada y fiscalizada por la ATT.

                    • Ventas al por mayor y menor ( Ínter Satelital )
                    • Cambios de equipos dañados.
                    • Cambios de nombre
                    • Venta de artículos en general
                    • Pago de mensualidad del servicio
                    • Instalación y mantenimiento del servicio de TV cable satelital.
                
</pre>
                <p>
                    @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">Home</a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Iniciar sesion</a>
                    @endauth
                    <!--<a class="btn btn-primary btn-lg" href="#" role="button">Iniciar sesion &raquo;</a> -->
                </p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <h2>Planes de internet</h2>
                    <p>Elige el plan que más te convenga Experiencia total. </p>
                    <p><a class="btn btn-secondary" href="https://www.facebook.com/InterSatelital.Support" role="button">Ver más</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Planes de Tv satelital</h2>
                    <p>Televisión Satelital HD con la mejor señal para todo Bolivia.</p>
                    <p><a class="btn btn-secondary" href="https://www.facebook.com/InterSatelital.Support" role="button">Ver más</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Soporte</h2>
                    <p>Solo disponible para usuarios con  de 2 mes sin el servicio (61 días)</p>
                    <p><a class="btn btn-secondary" href="https://www.facebook.com/InterSatelital.Support" role="button">Ver más</a></p>
                </div>
            </div>

            <hr>

        </div> <!-- /container -->

    </main>

    @include('layouts.theme.footer')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
</body>

</html>