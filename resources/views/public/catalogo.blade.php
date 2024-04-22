@extends("public.layout.public-layout")
@section("title", "Catalogo")
@push('javascript')
    <script src="{{asset("js/catalogo.js")}}"></script>
@endpush
@section("content")
    <div class="texture" style="background-image:url({{url('img/background4.jpg')}});">
        @if ($message = Session::get('success'))
            <p class="alert alert-success centered">{{ $message }}</p>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger centered">
                <p>¡ATENCIÓN! Los siguientes errores ocurrieron:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <p>{{ $error }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="search-section">
            {{ Form::open(["route" => "catalogo", "method" => "GET"]) }}
            <div class="search-form">
                <div class="search-bar flex-centered">
                    <button class="flex-centered" type="button" id="filterButton">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 512 512">
                            <path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/>
                        </svg>
                    </button>
                    {{ Form::search("search", app('request')->input('search'), ["id" => "search", "class" =>"search" , "placeholder" => "Busca un coche para alquilar..."]) }}
                    <button class="searchButton flex-centered" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 512 512">
                            <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/>
                        </svg>
                    </button>
                </div>
                <div id="toggle-filter">
                    <div class="filter-container">
                        <div class="filter price-filter">
                            <h3>Rango de precios</h3>
                            <div class="price-input">
                                <div class="field">
                                    <span>Min</span>
                                    {{ Form::number("priceMin",  app('request')->input('priceMin'), ["id" => "priceMin", "class" => "input-min"] ) }}
                                </div>
                                -
                                <div class="field">
                                    <span>Max</span>
                                    {{ Form::number("priceMax",  app('request')->input('priceMax'), ["id" => "priceMax", "class" => "input-min"] ) }}
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input class="range-min" type="range" min="0" max="5000" value="0" step="50">
                                <input class="range-max" type="range" min="0" max="5000" value="5000" step="50">
                            </div>
                        </div>
                        <div class="filter">
                            <h3>plazas vehículo</h3>
                            <div class="asientos-range">
                                {{ Form::select("asientos", ["" => "No especificado",
                                                          "2" => "2",
                                                          "3" => "3",
                                                          "4" => "4",
                                                          "5" => "5",
                                                          "6" => "6",
                                                          "7" => "7",
                                                          "8" => "8",
                                                          "9" => "9"], app('request')->input('asientos'), ["id" => "asientos", "class" => "centered"] ) }}
                            </div>
                        </div>
                        @can("isClient")
                            <div class="filter">
                                <h3>Recogida de vehículos</h3>
                                <div class="flex-cont">
                                    {{ Form::select("lugarRecogida",  ["Aeroporto di Alghero-Fertilia" => "Aeroporto di Alghero-Fertilia",
                                                                        "Aeroporto di Ancona-Falconara" => "Aeroporto di Ancona-Falconara",
                                                                        "Aeroporto di Bari-Palese" => "Aeroporto di Bari-Palese",
                                                                        "Aeroporto Bergamo-Orio al Serio" => "Aeroporto Bergamo-Orio al Serio",
                                                                        "Aeroporto di Bologna" => "Aeroporto di Bologna",
                                                                        "Aeroporto di Brescia-Montichiari" => "Aeroporto di Brescia-Montichiari",
                                                                        "Aeroporto di Brindisi-Casale" => "Aeroporto di Brindisi-Casale",
                                                                        "Aeroporto di Cagliari-Elmas" => "Aeroporto di Cagliari-Elmas",
                                                                        "Aeroporto di Catania-Fontanarossa" => "Aeroporto di Catania-Fontanarossa",
                                                                        "Aeroporto di Firenze-Peretola" => "Aeroporto di Firenze-Peretola",
                                                                        "Aeroporto di Genova-Sestri" => "Aeroporto di Genova-Sestri",
                                                                        "Aeroporto di Lamezia Terme" => "Aeroporto di Lamezia Terme",
                                                                        "Aeroporto di Lampedusa" => "Aeroporto di Lampedusa",
                                                                        "Aeroporto di Milano-Malpensa" => "Aeroporto di Milano-Malpensa",
                                                                        "Aeroporto di Milano-Linate" => "Aeroporto di Milano-Linate",
                                                                        "Aeroporto di Napoli-Capodichino" => "Aeroporto di Napoli-Capodichino",
                                                                        "Aeroporto di Olbia-Costa Smeralda" => "Aeroporto di Olbia-Costa Smeralda",
                                                                        "Aeroporto di Palermo-Punta Raisi" => "Aeroporto di Palermo-Punta Raisi",
                                                                        "Aeroporto di Parma" => "Aeroporto di Parma",
                                                                        "Aeroporto di Pescara" => "Aeroporto di Pescara",
                                                                        "Aeroporto di Pisa-San Giusto" => "Aeroporto di Pisa-San Giusto",
                                                                        "Aeroporto di Reggio Calabria" => "Aeroporto di Reggio Calabria",
                                                                        "Aeroporto di Rimini" => "Aeroporto di Rimini",
                                                                        "Aeroporto di Roma-Fiumicino" => "Aeroporto di Roma-Fiumicino",
                                                                        "Aeroporto di Roma-Ciampino" => "Aeroporto di Roma-Ciampino",
                                                                        "Aeroporto di Taranto-Grottaglie" => "Aeroporto di Taranto-Grottaglie",
                                                                        "Aeroporto di Torino-Caselle" => "Aeroporto di Torino-Caselle",
                                                                        "Aeroporto di Trapani-Birgi" => "Aeroporto di Trapani-Birgi",
                                                                        "Aeroporto di Trieste-Ronchi dei Legionari" => "Aeroporto di Trieste-Ronchi dei Legionari",
                                                                        "Aeroporto di Venezia-Marco Polo" => "Aeroporto di Venezia-Marco Polo",
                                                                        "Aeroporto di Verona-Villafranca" => "Aeroporto di Verona-Villafranca"], app('request')->input('lugarRecogida'), ["class" => "centered"]) }}
                                </div>
                                <div class="flex-cont">
                                    {{ Form::date("fechaRecogida", app('request')->input('fechaRecogida'), ["id" => "fechaRecogida", "class" => "date-input"]) }}
                                    {{ Form::select("horaRecogida", ["08:00" => "08:00",
                                                                  "08:30" => "08:30",
                                                                  "09:00" => "09:00",
                                                                  "09:30" => "09:30",
                                                                  "10:00" => "10:00",
                                                                  "10:30" => "10:30",
                                                                  "11:00" => "11:00",
                                                                  "11:30" => "11:30",
                                                                  "12:00" => "12:00",
                                                                  "12:30" => "12:30",
                                                                  "13:00" => "13:00",
                                                                  "13:30" => "13:30",
                                                                  "14:00" => "14:00",
                                                                  "14:30" => "14:30",
                                                                  "15:00" => "15:00",
                                                                  "15:30" => "15:30",
                                                                  "16:00" => "16:00",
                                                                  "16:30" => "16:30",
                                                                  "17:00" => "17:00",
                                                                  "17:30" => "17:30",
                                                                  "18:00" => "18:00",
                                                                  "18:30" => "18:30"], app('request')->input('horaRecogida'), ["class" => "centered"]) }}
                                </div>
                            </div>
                            <div class="filter">
                                <h3>Entrega de vehículos</h3>
                                <div class="flex-cont">
                                    {{ Form::select("lugarEntrega",  ["Aeroporto di Alghero-Fertilia" => "Aeroporto di Alghero-Fertilia",
                                                                          "Aeroporto di Ancona-Falconara" => "Aeroporto di Ancona-Falconara",
                                                                          "Aeroporto di Bari-Palese" => "Aeroporto di Bari-Palese",
                                                                          "Aeroporto Bergamo-Orio al Serio" => "Aeroporto Bergamo-Orio al Serio",
                                                                          "Aeroporto di Bologna" => "Aeroporto di Bologna",
                                                                          "Aeroporto di Brescia-Montichiari" => "Aeroporto di Brescia-Montichiari",
                                                                          "Aeroporto di Brindisi-Casale" => "Aeroporto di Brindisi-Casale",
                                                                          "Aeroporto di Cagliari-Elmas" => "Aeroporto di Cagliari-Elmas",
                                                                          "Aeroporto di Catania-Fontanarossa" => "Aeroporto di Catania-Fontanarossa",
                                                                          "Aeroporto di Firenze-Peretola" => "Aeroporto di Firenze-Peretola",
                                                                          "Aeroporto di Genova-Sestri" => "Aeroporto di Genova-Sestri",
                                                                          "Aeroporto di Lamezia Terme" => "Aeroporto di Lamezia Terme",
                                                                          "Aeroporto di Lampedusa" => "Aeroporto di Lampedusa",
                                                                          "Aeroporto di Milano-Malpensa" => "Aeroporto di Milano-Malpensa",
                                                                          "Aeroporto di Milano-Linate" => "Aeroporto di Milano-Linate",
                                                                          "Aeroporto di Napoli-Capodichino" => "Aeroporto di Napoli-Capodichino",
                                                                          "Aeroporto di Olbia-Costa Smeralda" => "Aeroporto di Olbia-Costa Smeralda",
                                                                          "Aeroporto di Palermo-Punta Raisi" => "Aeroporto di Palermo-Punta Raisi",
                                                                          "Aeroporto di Parma" => "Aeroporto di Parma",
                                                                          "Aeroporto di Pescara" => "Aeroporto di Pescara",
                                                                          "Aeroporto di Pisa-San Giusto" => "Aeroporto di Pisa-San Giusto",
                                                                          "Aeroporto di Reggio Calabria" => "Aeroporto di Reggio Calabria",
                                                                          "Aeroporto di Rimini" => "Aeroporto di Rimini",
                                                                          "Aeroporto di Roma-Fiumicino" => "Aeroporto di Roma-Fiumicino",
                                                                          "Aeroporto di Roma-Ciampino" => "Aeroporto di Roma-Ciampino",
                                                                          "Aeroporto di Taranto-Grottaglie" => "Aeroporto di Taranto-Grottaglie",
                                                                          "Aeroporto di Torino-Caselle" => "Aeroporto di Torino-Caselle",
                                                                          "Aeroporto di Trapani-Birgi" => "Aeroporto di Trapani-Birgi",
                                                                          "Aeroporto di Trieste-Ronchi dei Legionari" => "Aeroporto di Trieste-Ronchi dei Legionari",
                                                                          "Aeroporto di Venezia-Marco Polo" => "Aeroporto di Venezia-Marco Polo",
                                                                          "Aeroporto di Verona-Villafranca" => "Aeroporto di Verona-Villafranca"], app('request')->input('lugarEntrega'), ["class" => "centered"]) }}                                </div>
                                <div class="flex-cont">
                                    {{ Form::date("fechaEntrega", app('request')->input('fechaEntrega'), ["id" => "fechaEntrega", "class" => "date-input"]) }}
                                    {{ Form::select("horaEntrega", ["08:00" => "08:00",
                                                                  "08:30" => "08:30",
                                                                  "09:00" => "09:00",
                                                                  "09:30" => "09:30",
                                                                  "10:00" => "10:00",
                                                                  "10:30" => "10:30",
                                                                  "11:00" => "11:00",
                                                                  "11:30" => "11:30",
                                                                  "12:00" => "12:00",
                                                                  "12:30" => "12:30",
                                                                  "13:00" => "13:00",
                                                                  "13:30" => "13:30",
                                                                  "14:00" => "14:00",
                                                                  "14:30" => "14:30",
                                                                  "15:00" => "15:00",
                                                                  "15:30" => "15:30",
                                                                  "16:00" => "16:00",
                                                                  "16:30" => "16:30",
                                                                  "17:00" => "17:00",
                                                                  "17:30" => "17:30",
                                                                  "18:00" => "18:00",
                                                                  "18:30" => "18:30"], app('request')->input('horaEntrega'), ["class" => "centered"]) }}
                                </div>
                            </div>
                        @endcan
                        <div>
                        </div>
                        <div class="filter-btn-cont">
                            <button class="btn btn-light" type="reset">Reset</button>
                            <button class="btn btn-blue" type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </section>
        @if ($message = Session::get('empty'))
            <p class="alert alert-info centered">{{ $message }}</p>
        @endif
        <section class="result-section">
            <div class="result">
                @foreach($result as $alquiler)

                    @can("isClient")
                        {{ Form::open(["route" => ["alquiler.store"], "method" => "POST", "class" => "car-item"]) }}
                        {{ Form::hidden("id", Crypt::encrypt($alquiler->id)) }}
                        {{ Form::hidden("fechaRecogida", Crypt::encrypt(app('request')->input('fechaRecogida'))) }}
                        {{ Form::hidden("lugarRecogida", Crypt::encrypt(app('request')->input('lugarRecogida'))) }}
                        {{ Form::hidden("horaRecogida", Crypt::encrypt(app('request')->input('horaRecogida'))) }}
                        {{ Form::hidden("fechaEntrega", Crypt::encrypt(app('request')->input('fechaEntrega'))) }}
                        {{ Form::hidden("lugarEntrega", Crypt::encrypt(app('request')->input('lugarEntrega'))) }}
                        {{ Form::hidden("horaEntrega", Crypt::encrypt(app('request')->input('horaEntrega'))) }}
                    @endcan()

                    @cannot("isClient")
                        <div class="car-item">
                    @endcannot
                            <div class="car-name">{{ $alquiler->modelo }}</div>
                            <div class="car-brand">{{ $alquiler->marca }}</div>
                            <a href="{{route("vehiculo.show", $alquiler->id)}}">info</a>
                            <img class="car-image" src="{{ asset($alquiler->foto) }}">
                            <ul class="car-details">
                                <li>
                                    <img src="{{asset("img/icon/gas-station.png")}}" width="16" height="16">
                                    {{$alquiler->motor}}
                                </li>
                                <li>
                                    <img src="{{asset("img/icon/porta-vehiculo.png")}}" width="16" height="16">
                                    {{$alquiler->puertas}}
                                </li>
                                <li>
                                    <img src="{{asset("img/icon/equipaje.png")}}" width="16" height="16">
                                    {{$alquiler->equipaje}}
                                </li>
                                <li>
                                    <img src="{{asset("img/icon/cambio.png")}}" width="16" height="16">
                                    {{$alquiler->cambio}}
                                </li>
                                <li>
                                    <img src="{{asset("img/icon/asientos-vehiculo.png")}}" width="16" height="16">
                                    {{$alquiler->asientos}}
                                </li>
                            </ul>
                            <div class="car-price">{{$alquiler->costoDiario}} €/gg</div>

                            @can("isClient")
                                <div class="car-tot-price">Totale periodo: {{$alquiler->costoDiario *  date_diff(date_create(app("request")->input("fechaRecogida")), date_create(app("request")->input("fechaEntrega")))->days}} €</div>
                                @can("doesntHaveNoleggio")
                                    {{ Form::button("Libro", ["class" => "btn-rect btn-blue btn-large", "type" => "submit"]) }}
                                @endcan
                                @cannot("doesntHaveNoleggio")
                                    <div class="warning-car">
                                    Ya tienes una reserva
                                    </div>
                                @endcannot
                            @endcan

                            @cannot("isClient")
                                <div class="warning-car">
                                Reserva reservada para clientes
                                </div>
                            @endcannot

                    @can("isClient")
                        {{ Form::close() }}
                    @endcan()

                    @cannot("isClient")
                        </div>
                    @endcannot

                @endforeach
            </div>
        </section>
        @if($result != [])
            {{ $result->withQueryString()->links("helpers.pagination") }}
        @endif
    </div>
@endsection

