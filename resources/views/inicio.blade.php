<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">


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

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Registrarse</a>
                    @endif
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
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Planes de Tv satelital</h2>
                    <p>Plan Full HD por solo 195 Bs. ¡Tus películas favoritas en HD! Conoce nuestro plan InterSatelital en HD. Disfruta con tu familia los 38 canales en la mejor definición. Podrás ver los mejores partidos y los últimos estrenos desde la comodidad de tu casa</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Soporte</h2>
                    <p>Solo disponible para usuarios con  de 2 mes sin el servicio (61 días)

DESCUENTOS EN SUS MENSUALIDADES:

1 Equipo:   paga 129 Bs. Durante 2 meses.
2 Equipos: paga 165 Bs. Durante 2 meses.
3 Equipos: paga 201 Bs. Durante 2 meses.

¿CÓMO ADQUIRIR EL DESCUENTO?⁉️

↪Solicitar su descuento ANTES DE CANCELAR su mensualidad llamando a nuestro personal autorizado
 Cel. o WhatsApp: 69162811 - 68753388
 teléfono:  33239186</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div>
            </div>

            <hr>

        </div> <!-- /container -->

    </main>

    <footer class="container">
        <p>&copy; Company 2017-2018</p>
    </footer>

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