@extends("public.layout.public-layout")
@section("title", "Home")
@section("content")
<section id="intro" style="background-image:url({{url('img/car2.jpg')}}),linear-gradient(to bottom, transparent, black)">
    <div>
        <p id="slogan">HAZ TU VIAJE MEMORABLE</p>
        <a href="{{route("documentacion")}}" target="_blank" id="doc-link">Documentación
            <span id="play-icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                </svg>
            </span>
        </a>
    </div>
</section>
<section class="default-section" id="chi-siamo">
    <div class="row-flex">
        <div class="cell-1of2">
            <h1>Quienes somos</h1>
            <p>Somos <b>Green Car Rent</b>: tu <b>socio de movilidad sostenible</b>.
                Nos especializamos en ofrecer <b>transporte ecológico y accesible</b> a empresas y particulares.
                Nuestra flota de <b>vehículos eléctricos de última generación</b> está disponible para alquiler
                en modalidades de <b>corta, media y larga duración</b>.
                Ubicados en el <b>Aeropuerto de Barcelona-El Prat</b>, somos tu opción de confianza para
                <b>soluciones de movilidad sostenibles</b> en la ciudad y más allá. Ofrecemos
                <b>tarifas competitivas</b> y un <b>servicio de calidad</b> en cada alquiler para que disfrutes
                de tus viajes con total tranquilidad.
            </p>
        </div>
        <div class="cell-1of2">
            <img src="{{asset("img/car2.jpg")}}">
        </div>
    </div>
</section>
<section class="default-section dark-section">
    <h1>Alquilar es <span id="text-animation"></span></h1>
    <p>
        <b>Green Car Rent</b>: movilidad sostenible al alcance de tus vacaciones y negocios.
        Disfruta de la comodidad de recoger un <b>coche eléctrico</b> nuevo directamente en el <b>Aeropuerto de Barcelona-El Prat</b>, de manera rápida, segura y sencilla.
        <br> El alquiler de coches eléctricos es la mejor opción para tus desplazamientos en España, con presencia destacada en <b>Cataluña</b>.
        <br>¡Haz la prueba y descubre una nueva forma de viajar!</b>
    </p>
</section>
<section class="default-section">
    <h1>Nuestros servicios</h1>
    <div class="row-flex">
        <div class="cell-1of2">
            <div class="service-item" style="background-image:url({{url('img/rental-car2.jpg')}})">
                <div class="visible-div">
                    <h2>Alquiler a corto plazo</h2>
                </div>
                <div class="hidden-div">
                    <p> Adecuado en aquellas situaciones en las que te ves obligado a reorganizar y planificar.
                        propio
                        viajar con cierta frecuencia.</p>
                    <a class="btn-rect btn-outline-dark" href="{{route("catalogo")}}">
                        Saber más</a>
                </div>
            </div>
        </div>
        <div class="cell-1of2">
            <div class="service-item" style="background-image:url({{url('img/rental-car.jpg')}})">
                <div class="visible-div">
                    <h2>Alquiler a largo plazo</h2>
                </div>
                <div class="hidden-div">
                    <p>
                        Adecuado cuando se quiere utilizar el coche a diario sin tener que comprarlo.
                        y tener que pagar los costos de mantenimiento</p>
                    <a class="btn-rect btn-outline-dark" href="{{route("catalogo")}}">
                        Saber más</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="default-section dark-section">
    <div class="row-flex">
        <div class="cell-1of2">
            <h1>Detalles de contacto</h1>
            <address>
                <a href="tel:3115552368" title="Numero Assistenza">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                    </svg>
                    +34 93 555 2368
                </a>
                <a href="mailto:GreenCarRent.empleado@example.com" title="E-mail Empleado">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                    </svg>
                    GreenCar.staff@example.com
                </a>

                <a href="https://goo.gl/maps/BdGKS9Lk3qiFF5We9" title="Sede Legale">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                    </svg>
                    Carrer de la Selva Selva 9, Prat Llobregat Bcn
                </a>
            </address>
        </div>
        <div class="cell-1of2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5993.741692700179!2d2.0734176!3d41.31167320000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a49f3b0809fca9%3A0x3c5fdbdc8f8cf06c!2sAvis%20Alquiler%20de%20coches%20-%20Prat%20Llobregat%20Bcn!5e0!3m2!1ses!2ses!4v1711301255113!5m2!1ses!2ses" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
@endsection