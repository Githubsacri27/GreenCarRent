@extends("public.layout.public-layout")
@section("title", "Condiciones")

@section("content")
    <section class="container my-5 pt-4">
        <h1 class="mb-4">Términos y condiciones</h1>
        <p>
            El alquiler de vehículos por parte de la empresa Green Car Rent se rige por las siguientes condiciones generales de alquiler: la Política de Privacidad, la carta de alquiler firmado por el cliente, la Lista de Precios, y la Política de daños que se le facilitarán de forma física en nuestro establecimiento. El Cliente declara haber consultado todos los documentos antes mencionados y haber tenido pleno y completo conocimiento de los mismos. Al firmar la Carta de Alquiler, el Cliente declara haber leído y aceptado las Condiciones Generales de Alquiler.
        </p>
    </section>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <section class="bg-light p-4 rounded">
                    <h2>Acceso a servicios</h2>
                    <p>
                        La plataforma no impone restricciones a la consulta de ofertas. El alquiler es permitido solo a usuarios registrados. La inscripción está reservada solo a personas en posesión del permiso de conducción B y una edad mínima de 18 años. Si no tienes una cuenta, puedes crear una de forma totalmente gratuita en la siguiente <a href="{{ route('register') }}" class="text-primary">dirección</a>.
                    </p>
                </section>
            </div>
            <div class="col-md-6 mb-4">
                <section class="bg-light p-4 rounded">
                    <h2>FAQ</h2>
                    <p>
                        ¿Necesitas ayuda? Nosotros te llamamos. Servicio GRATUITO de atención telefónica. Déjanos tu número de teléfono y contactaremos contigo lo antes posible.
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection
