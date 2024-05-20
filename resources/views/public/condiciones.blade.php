@extends("public.layout.public-layout")
@section("title", "Condiciones")

@section("content")
<section class="container my-5 pt-4">
    <div class="text-center mb-5">
        <h1 class="mb-4">Términos y Condiciones</h1>
        <p class="lead">
            El alquiler de vehículos por parte de Green Car Rent se rige por las siguientes condiciones generales. A continuación, se detallan los aspectos más importantes que debe conocer.
        </p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <section class="bg-light p-4 rounded">
                <h2>Condiciones Generales</h2>
                <p>
                    En Green Car Rent, nos esforzamos por proporcionar un servicio transparente y claro. En nuestras oficinas, encontrará los documentos clave que rigen nuestro servicio de alquiler:
                </p>
                <ul>
                    <li><strong>Política de Privacidad:</strong> Detalla cómo manejamos y protegemos su información personal.</li>
                    <li><strong>Carta de Alquiler:</strong> Un documento firmado por usted al momento de alquilar un vehículo, que confirma su aceptación de nuestras condiciones.</li>
                    <li><strong>Lista de Precios:</strong> Incluye todas nuestras tarifas de alquiler y otros cargos aplicables.</li>
                    <li><strong>Política de Daños:</strong> Explica nuestras reglas y procedimientos en caso de que el vehículo sufra algún daño durante el período de alquiler.</li>
                </ul>
                <p>
                    Todos estos documentos estarán disponibles en formato físico en nuestro establecimiento. Al firmar la Carta de Alquiler, usted confirma que ha leído y aceptado todas las condiciones mencionadas. Si lo desea, se lo podemos enviar por correo electrónico.
                </p>
            </section>
        </div>
        <div class="col-md-6 mb-4">
            <section class="bg-light p-4 rounded">
                <h2>Acceso a Servicios</h2>
                <p>
                    Puede explorar nuestras ofertas libremente, pero para alquilar un vehículo debe estar registrado. El registro está disponible para:
                </p>
                <ul>
                    <li>Personas con un permiso de conducción tipo B.</li>
                    <li>Personas mayores de 18 años.</li>
                </ul>
                <p>
                    Si aún no tiene una cuenta, puede crear una de manera gratuita haciendo clic en <a href="{{ route('register') }}" class="text-primary">este enlace</a>.
                </p>
            </section>
        </div>
        <div class="col-md-6 mb-4">
            <section class="bg-light p-4 rounded">
                <h2>FAQ</h2>
                <p>
                    ¿Tienes preguntas? Estamos aquí para ayudarte. Ofrecemos un servicio gratuito de atención telefónica. Déjenos su número y te llamaremos lo antes posible.
                </p>
                <address>
                    <a href="tel:+34 93 555 2368" title="Número de asistencia" class="d-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                        </svg>
                        +34 93 555 2368
                    </a>
                    <a href="mailto:GreenCarRent@soporte.com" title="E-mail Empleado" class="d-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill me-2" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                        GreenCarRent@soporte.com
                    </a>
                    <a href="https://goo.gl/maps/BdGKS9Lk3qiFF5We9" title="Sede Legal" class="d-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill me-2" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                        </svg>
                        Carrer de la Selva 9, Prat Llobregat Bcn
                    </a>
                </address>
            </section>
        </div>
    </div>
</section>
@endsection