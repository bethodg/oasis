<div class="card">
    <h4 class="card-header"><strong>{{ $servicio[0]->nombre }}</strong></h4>
    <img width="80%" height="80%" src="https://api-onow.oasishoteles.net/{{$servicio[0]->img_portada}}" class="img-thumbnail card-img-top" alt="...">

    <div class="card-body">

    <h5 class="card-title"><em>{{ $servicio[0]->concepto_es }}</em></h5>
    <p class="mb-1 fw-bold">Abierto hoy</p>
        <div class="row">
            <div class="col-12  mt-2">
                <span><mark>{{date('h:i a', strtotime($servicio[0]->hora_inicio))}} - {{date('h:i a', strtotime($servicio[0]->hora_final))}}</mark></span>
            </div>
            @if(!empty($servicio[0]->extra_horas) )
                @foreach ( $servicio[0]->extra_horas as $extra_horario)
                    <div class="col-12  mt-2">
                        <span><mark>{{date('h:i a', strtotime($extra_horario['hora_inicio']))}} - {{date('h:i a', strtotime($extra_horario['hora_final']))}}</mark></span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>