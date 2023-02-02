<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oasis</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src=" https://cdn.jsdelivr.net/npm/waitme@1.19.0/waitMe.min.js "></script>
        <link href=" https://cdn.jsdelivr.net/npm/waitme@1.19.0/waitMe.min.css " rel="stylesheet">
        <!-- Styles -->
        <style>
            .container {
            max-width: 960px;
            }

            /*
            * Custom translucent site header
            */

            .site-header {
            background-color:#6cc7e2;
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            backdrop-filter: saturate(180%) blur(20px);
            }
            .site-header a {
            color: #8e8e8e;
            transition: color .15s ease-in-out;
            }
            .site-header a:hover {
            color: #fff;
            text-decoration: none;
            }

            /*
            * Dummy devices (replace them with your own or something else entirely!)
            */

            .product-device {
            position: absolute;
            right: 10%;
            bottom: -30%;
            width: 300px;
            height: 540px;
            background-color: #333;
            border-radius: 21px;
            transform: rotate(30deg);
            }

            .product-device::before {
            position: absolute;
            top: 10%;
            right: 10px;
            bottom: 10%;
            left: 10px;
            content: "";
            background-color: rgba(255, 255, 255, .1);
            border-radius: 5px;
            }

            .product-device-2 {
            top: -25%;
            right: auto;
            bottom: 0;
            left: 5%;
            background-color: #e5e5e5;
            }


            /*
            * Extra utilities
            */

            .flex-equal > * {
            flex: 1;
            }
            @media (min-width: 768px) {
            .flex-md-equal > * {
                flex: 1;
            }
            }
            #bg-image{
                background-image: url("https://spaceohrtest.sfo2.digitaloceanspaces.com/assets/img/home/slide/bkgr-home.webp");
                background-position: center !important;
                background-repeat: no-repeat !important;
                -moz-background-size: cover !important;
                background-size: cover !important;
                min-height: 100%;
            }
            #bg-footer{
                background: radial-gradient(circle, #1f9ce3 0%, #0c7ebf 28.15%, #0c486a 100%);
                background-color: rgba(0, 0, 0, 0);
            }
            mark{
                background-color: #d6dbec !important;
            }
            
        </style>
    </head>
    
    <body>
        <header class="site-header sticky-top py-1">
            <nav class="container d-flex flex-column flex-md-row justify-content-center">
                <a class="py-2" href="#" aria-label="Product">
                <img class="mx-auto" width="34" height="34" src="https://spaceohrtest.sfo2.digitaloceanspaces.com/assets/img/logos/corporativo/oasis-brand.svg" alt="Logo Oasis Corporativo">
                </a>
                
            </nav>
        </header>
        <div id="bg-image" class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">

            <div class="col-md-6 p-lg-6 mx-auto my-5">
                <h1 class="display-4 fw-normal text-white">Restaurantes exclusivos</h1>
                <p class="lead fw-normal text-white">Sazones que sorprenden al paladar más exigente, fusiones que van más allá de la imaginación e innovadoras técnicas culinarias con reconocimiento internacional; así es el mundo de los sabores en Oasis Hotels & Resorts. En nuestros restaurantes hallarás gran variedad y diversas razones para emprender una aventura gastronómica cada día. Reserva tu estancia en plan todo incluido y explora las delicias que ofrece nuestra exquisita cocina de autor. </p>
                
            </div>
            
        </div>
        
        <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">

            <!-- Restaurantes -->
                <div class="text-bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                    <div class="my-3 py-3">
                    <h2 class="display-5 fw-bold">Restaurantes</h2>
                    
                    </div>
                    <div class="bg-light shadow-sm mx-auto" style="width: 100%; min-height:300px; height: 100%; border-radius: 21px 21px 0 0; color:#333">
                        @foreach ( $restaurantes as $restaurant)
                            <div class="row">
                                <div class="col-12"><h3 class="mt-3"><strong>{{ $restaurant->nombre }}</strong></h3></div>
                                <div class="col-12"><p class="mb-2"><em>{{ $restaurant->concepto_es }} </em></p></div>
                                <div class="col-6">
                                    <p class="mb-1">Abierto hoy</p>
                                    <span><mark>{{date('h:i a', strtotime($restaurant->hora_inicio))}} - {{date('h:i a', strtotime($restaurant->hora_final))}}</mark></span>
                                </div>
                
                                <div class="col-6">
                                    <a class="btn btn-outline-secondary mt-3 oasis-service" data-categoria="2" data-id="{{$restaurant->id}}" href="{{ route('card') }}">ver mas</a>
                                </div>
                                @if(!empty($restaurant->extra_horas) )
                                    <div class="col-12">
                                        <p class="m-2">
                                            <a class="link-dark" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Mas horarios
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body" style="border-radius: 0px !important;">
                                                <div class="row">
                                                    @foreach ( $restaurant->extra_horas as $extra_horario)
                                                        <div class="col-6">
                                                            <span><mark>{{date('h:i a', strtotime($extra_horario['hora_inicio']))}} - {{date('h:i a', strtotime($extra_horario['hora_final']))}}</mark></span>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 mt-2">----------------------------------------------------------</div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            <!-- Restaurantes Final -->

            <!-- Bares -->
                <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                    <div class="my-3 p-3">
                    <h2 class="display-5 fw-bold">Bares</h2>
                
                    </div>
                    <div class="bg-dark shadow-sm mx-auto text-white" style="width: 100%; min-height:300px; height: 100%; border-radius: 21px 21px 0 0;">
                        @foreach ( $bares as $bar)
                            <div class="row">
                                <div class="col-12"><h3 class="mt-3"><strong>{{ $bar->nombre }}</strong></h3></div>
                                <div class="col-12"><p class="mb-2"><em>{{ $bar->concepto_es }} </em></p></div>
                                <div class="col-6">
                                    <p class="mb-1">Abierto hoy</p>
                                    <span><mark>{{date('h:i a', strtotime($bar->hora_inicio))}} - {{date('h:i a', strtotime($bar->hora_final))}}</mark></span>
                                </div>
                
                                <div class="col-6">
                                    <a class="btn btn-outline-light mt-4 oasis-service" data-categoria="3" data-id="{{$bar->id}}" href="{{ route('card') }}">ver mas</a>
                                </div>
                                @if(!empty($bar->extra_horas) )
                                    <div class="col-12">
                                        <p class="m-2">
                                            <a class="link-light" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Mas horarios
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body" style="border-radius: 0px !important;">
                                                
                                                <div class="row">
                                                    @foreach ( $bar->extra_horas as $extra_horario)
                                                        <div class="col-6">
                                                            <span><mark>{{date('h:i a', strtotime($extra_horario['hora_inicio']))}} - {{date('h:i a', strtotime($extra_horario['hora_final']))}}</mark></span>

                                                        </div>
                                                    @endforeach
                                                </div>

                                            
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 mt-2">----------------------------------------------------------</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            <!-- Bares Final -->

            <!-- Vista Previa -->
                <div class="text-bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                    <div class="my-3 p-3">
                    <h2 class="display-5 fw-bold">Vista Previa</h2>
                
                    </div>
                    <div class="bg-light shadow-sm mx-auto" style="width: 80%; min-height:300px; height: 100%; border-radius: 21px 21px 0 0; color:#333">
                        <div class="row">
                            <div id="oasis-card" class="col-12 mt-0">
                                
                                <div class="card">
                                    <h4 class="card-header"><strong>Makitako</strong></h4>
                                    <img width="80%" height="80%" src="https://api-onow.oasishoteles.net/public/uploads/centros_consumo/bares/schillabar/logo-1526483124718.png" class="img-thumbnail card-img-top" alt="...">

                                    <div class="card-body">

                                    <h5 class="card-title"><em>Fusión Mexicana-Japonesa  </em></h5>
                                    <p class="mb-1 fw-bold">Abierto hoy</p>
                                        <div class="row">
                                            <div class="col-12  mt-2">
                                                <span><mark>01:00 pm - 06:00 pm</mark></span>
                                            </div>
                                            <div class="col-12  mt-2">
                                                <span><mark>06:00 pm - 11:00 pm</mark></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Vista Previa Final -->
        </div>
    
        <footer id="bg-footer" class="footer mt-auto py-3 bg-light">
            <div class="container d-flex flex-column flex-md-row justify-content-center">
                <a class="py-2" href="#" aria-label="Product">
                <img class="mx-auto" width="34" height="34" src="https://spaceohrtest.sfo2.digitaloceanspaces.com/assets/img/logos/corporativo/oasis-brand.svg" alt="Logo Oasis Corporativo">
                </a>
                
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script>
            $(function(){
                
                $('.oasis-service').on('click', function(e) {
                    e.preventDefault();
                    var btn = $(this);
                    $('body').waitMe({color: '#138ACD' });
                    $.ajax({
                        type: 'get',
                        url: btn.attr('href'),
                        dataType: 'json',
                        data: {
                            id: btn.data('id'), 
                            categoria: btn.data('categoria')
                        },
                        success: function (data) {
                            //console.log(data);
                            if (data.status == 'ok') {
                                $("#oasis-card").html(data.data);
                            } else {
                                alert("Error");
                            }
                            $('body').waitMe('hide');
                        },
                        error: function () {
                            alert("Error");
                            $('body').waitMe('hide');
                        }
                    });
                });
            });
        </script>
    </body>
    
</html>
