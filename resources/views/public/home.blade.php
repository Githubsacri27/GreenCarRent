@extends("public.layout.public-layout")
@section("title", "Home")
@section("content")

<!-- Video de fondo -->
<div class="video-background">
    <video muted autoplay loop>
        <source src="{{ asset('video/bosque2.mp4') }}" type="video/mp4">
    </video>
</div>

<!-- Documentación-->
<section class="text-center content-section">

    <div class="text-center">
        <h2 class="fw-normal">¡Novedades!</h2>
        <p>Descubre nuestro Catálogo! Alquila de forma rápida, y segura.</p>
        <p><a class="btn btn-primary" aria-current="page" href="{{route('catalogo')}}">Ver Catálogo
        <span id="play-icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
            </svg>
        </span>
        </a></p>
    </div>
</section>
@endsection