@extends("public.layout.public-layout")
@section("title", "condiciones")
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
<section class="default-section">
    <h1>Términos y condiciones</h1>
    <p>
        El alquiler de vehículos por parte de la empresa Green Car Rent se rige por estas condiciones generales de alquiler (en adelante, las “Condiciones Generales de Alquiler”), incluyendo la Política de Privacidad, la carta de alquiler (en adelante, la “Carta de Alquiler” o la “ Contrato”) firmado por el cliente (en adelante, el “Cliente” o el “Arrendatario”) en el momento del alquiler de un vehículo (en adelante, el “Vehículo”), de la Lista de Precios vigente en el momento de la firma del mismo Alquiler Carta (publicada en línea en el sitio web www.GreenCarRent.es) y Política de daños. El Cliente declara haber consultado todos los documentos antes mencionados (en adelante, colectivamente, la "Documentación Contractual") y haber tenido pleno y completo conocimiento de los mismos. Al firmar la Carta de Alquiler, el Cliente declara haber leído y aceptado las Condiciones Generales de Alquiler y aprobar específicamente los siguientes artículos: Art. 2 (Métodos y plazos de reserva y pago del alquiler), Art. 5 (Circulación del Vehículo y condiciones de uso), Art. 6 (Recepción y devolución del Vehículo), Art. 7 (Responsabilidad del Cliente), Art. 8 (Contrato en nombre y/o por cuenta de terceros y responsable solidario), Art. .10 (Cargos), Art. 11 (Uso de dispositivos satelitales), Art. 12 (Cláusula de rescisión), Art. 14 (Modificaciones contractuales), Art. 15 (Ley aplicable y jurisdicción exclusiva), Art. 16 (Traducción), Art. 17 (Interpretación), Art. 18 (Domicilio y comunicaciones).</p>
</section>
<div class="row-flex">
    <div class="cell-1of2">
        <section class="default-section dark-section">
            <h1>Acceso a servicios</h1>
            <p>
                La plataforma no impone restricciones a la consulta de ofertas. El alquiler es
                permitido sólo a usuarios registrados. La inscripción está reservada a las personas en posesión de
                permiso de conducción B y edad comprendida entre 19 y 75 años. En el caso de no disponer de una cuenta, puede crear una de forma totalmente gratuita en la siguiente <a href="{{route("register")}}" class="std-link">dirección</a>. Una vez autenticado el usuarios pueden cambiar su información personal y si es necesario contactar al administrador del
                sitio en caso de problemas. Los miembros del personal pueden iniciar sesión en el sistema utilizando el
                cartas credenciales acceso proporcionado por el administrador.
            </p>
        </section>
    </div>
    <div class="cell-1of2">
        <section class="default-section">
            <h1>FAQ</h1>
            <p>
                ¿Necesitas ayuda? Consulte la página dedicada a la lista de las preguntas más frecuentes sobre
                algunos temas y actividades presentes en la plataforma Green Car Rent.
            </p>

        </section>
    </div>
</div>
@endsection