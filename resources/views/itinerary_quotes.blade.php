@extends('layouts.dashboard')

@section('content')
    @foreach($paquete as $paquete)
        <div class="row">
            <div class="col s12">
                <h5 class="center-align lime-text text-darken-3"><b>Package Travel: {{$paquete->titulo}}</b></h5>
                <p><b>Package Code:</b> {{$paquete->codigo}} | <b>Package Duration:</b> {{$paquete->duracion}} | <a href="" class="waves-effect waves-light red-text"> view version PDF</a></p>

                <p class="center-align margin-top-20">
                    {{--<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>--}}
                    <a href="#confirm" class="waves-effect waves-light btn red modal-trigger">Confirmar Ahora</a>
                    <a href="#upgrade" class="waves-effect waves-light btn blue modal-trigger">Request Changes</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col s12">

                <p class="yellow-text text-darken-3"><b>Incluye</b></p>
                <p>{{$paquete->incluye}}</p>
                <p class="yellow-text text-darken-3"><b>No Incluye</b></p>
                <p>{{$paquete->noincluye}}</p>
                <p class="yellow-text text-darken-3"><b>Opcional</b></p>
                <p>{{$paquete->opcional}}</p>

            </div>
        </div>
        <div class="row">
            <div class="col s12 tabs-detail margin-bottom-20">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#days" class="active">Itinerary for days</a></li>
                    <li class="tab col s3"><a href="#hours">Itinerary for hours</a></li>
                    <li class="tab col s3"><a href="#services">Services</a></li>
                </ul>
            </div>
            <div id="days" class="col s12">
                @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                    <h6><b>Day {{$itinerario->dias}} - {{$itinerario->titulo}} ({{$itinerario->fecha}})</b></h6>
                    <p>{{$itinerario->descripcion}}</p>
                @endforeach
            </div>
            <div id="hours" class="col s12">
                @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)

                    <div class="row">
                        <div class="col s4">
                            <p><b>Day {{$itinerario->dias}} - {{$itinerario->titulo}}</b></p>
                            <p>({{$itinerario->fecha}})</p>
                        </div>
                        <div class="col s8">
                            @foreach($itinerario->horas_cotizaciones->sortBy('hora') as $horas)
                                <p><b>{{$horas->hora}}</b> - {{$horas->descripcion}})</p>
                            @endforeach
                        </div>
                    </div>

                @endforeach
            </div>
            <div id="services" class="col s12">
                @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                    <div class="row">
                        <div class="col s12">
                            <h6><b>Day {{$itinerario->dias}} - {{$itinerario->titulo}} ({{$itinerario->fecha}})</b></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m9 offset-m1">
                            <table class="bordered striped highlight responsive-table">
                                <thead>
                                <tr>
                                    <th data-field="id">Concepto</th>
                                    <th data-field="name">Observaciones</th>
                                    <th data-field="price">Precio</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($itinerario->servicios_cotizaciones as $servicios)
                                    <tr>
                                        <td>{{$servicios->tiposervicio}}</td>
                                        <td>{{$servicios->observaciones}}</td>
                                        <td>${{$servicios->precio}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


        <div class="col s3 box-static-price">
            <p class="yellow-text text-darken-3"><b>Acomodacion del paquete:</b></p>
            @foreach($paquete->precio_paquetes as $precio)
                <p>
                    <input name="group1" type="radio" id="test{{$precio->estrellas}}" checked />
                    <label for="test{{$precio->estrellas}}">{{$precio->estrellas}} star: ${{$precio->precio_d}}</label>
                </p>
            @endforeach

            <p class="yellow-text text-darken-3"><b>Destinos incluidos:</b></p>

            @foreach($paquete->paquetes_destinos as $destino)
                <p>
                    <input type="checkbox" id="test1" checked="checked" disabled="disabled" />
                    <label for="test1">{{ucwords(strtolower($destino->destinos->nombre))}}</label>
                </p>
            @endforeach

        </div>


        <!-- Modal Structure -->
        <div id="confirm" class="modal">
            <div class="modal-content">
                <h5>Estas seguro de confirmar?</h5>
                <p class="margin-top-40">El paquete personalizado se confirmara para su viaje de ensueño</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat green white-text"><i class="material-icons right">thumb_up</i>Confirmar</a>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="upgrade" class="modal bottom-sheet">
            <div class="container">
                <div class="modal-content">
                    <h5>Request changes / upgrades</h5>
                    <p>Ingrese los posibles cambio y sugerencias para personalizar adecuadamente su paquete</p>
                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Textarea</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons right">send</i> Agree</a>
                </div>
            </div>
        </div>



    @endforeach
    @stop