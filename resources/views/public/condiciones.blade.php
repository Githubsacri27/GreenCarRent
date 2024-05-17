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
                    En Green Car Rent, nos esforzamos por proporcionar un servicio transparente y claro. A continuación, encontrará los documentos clave que rigen nuestro servicio de alquiler:
                </p>
                <ul>
                    <li><strong>Política de Privacidad:</strong> Detalla cómo manejamos y protegemos su información personal.</li>
                    <li><strong>Carta de Alquiler:</strong> Un documento firmado por usted al momento de alquilar un vehículo, que confirma su aceptación de nuestras condiciones.</li>
                    <li><strong>Lista de Precios:</strong> Incluye todas nuestras tarifas de alquiler y otros cargos aplicables.</li>
                    <li><strong>Política de Daños:</strong> Explica nuestras reglas y procedimientos en caso de que el vehículo sufra algún daño durante el período de alquiler.</li>
                </ul>
                <p>
                    Todos estos documentos estarán disponibles en formato físico en nuestro establecimiento. Al firmar la Carta de Alquiler, usted confirma que ha leído y aceptado todas las condiciones mencionadas.
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
                    ¿Tienes preguntas? Estamos aquí para ayudarte. Ofrecemos un servicio gratuito de atención telefónica. Déjanos tu número y te llamaremos lo antes posible.
                </p>
            </section>
        </div>
    </div>
</section>
@endsection