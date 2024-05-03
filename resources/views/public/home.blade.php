@extends("public.layout.public-layout")
@section("title", "Home")
@section("content")
<section>
    <div class="text-center">
        <p id="slogan" class="display-4 fw-bold">HAZ TU VIAJE MEMORABLE</p>
        <a href="{{route("documentacion")}}" target="_blank" class="btn btn-primary">
            Documentación
            <span id="play-icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                </svg>
            </span>
        </a>
    </div>
</section>

<section class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1>Quiénes somos</h1>
            <p>Somos <b>Green Car Rent</b>: tu <b>socio de movilidad sostenible</b>.
                Nos especializamos en ofrecer <b>transporte ecológico y accesible</b> a empresas y particulares.
                Nuestra flota de <b>vehículos eléctricos de última generación</b> está disponible para alquiler
                en modalidades de <b>corta, media y larga duración</b>.
                Ubicados en el <b>Aeropuerto de Barcelona-El Prat</b>, somos tu opción de confianza para
                <b>soluciones de movilidad sostenibles</b> en la ciudad y más allá. Ofrecemos
                <b>tarifas competitivas</b> y un <b>servicio de calidad</b> en cada alquiler para que disfrutes
                de tus viajes con total tranquilidad.
            </p>
            <div class="col-lg-4">
                <img class="bd-placeholder-img rounded-circle" src="{{asset('img/car2.jpg')}}" alt="" width="140" height="140">
                <h2 class="fw-normal">¡Novedades!</h2>
                <p>Descubre nuestro Catálogo! Alquila de forma rápida, y segura.</p>
                <p><a class="btn btn-primary" aria-current="page" href="{{route('catalogo')}}">Ver Catálogo</a></p>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{asset('img/car2.jpg')}}" class="img-fluid" alt="Imagen de Green Car Rent ">
        </div>
    </div>
</section>

<section class="bg-secondary text-light py-5 text-center">
    <div class="container">
        <h1 class="display-4">Movilidad sostenible a un precio accesible <span id="text-animation" class="fw-bold"></span></h1>
        <p class="lead">
            <b>Green Car Rent</b>: movilidad sostenible al alcance de tus vacaciones y negocios.
            Disfruta de la comodidad de recoger un <b>coche eléctrico</b> nuevo directamente en el
            <b>Aeropuerto de Barcelona-El Prat</b>, de manera rápida, segura y sencilla.
            <br> El alquiler de coches eléctricos es la mejor opción para tus desplazamientos en España, con presencia destacada en
            <b>Cataluña</b>.
            <br>¡Haz la prueba y descubre una nueva forma de viajar!
        </p>
    </div>
</section>

@endsection