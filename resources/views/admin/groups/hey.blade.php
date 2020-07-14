                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Actividad</td>
                                    <td>Fecha de Inicio</td>
                                    <td>Fecha Final</td>
                                    <td>Observación</td>
                                    <td colspan="2">Acción</td>
                                </tr>
                            </thead>
                            <tbody>                        
                                @foreach($group->activities as $activity)
                                <tr>    
                                    <td>{{ $activity->pivot->id }}</td>
                                    <td>{{ $activity->name }}</td>
                                    <td>{{ $activity->start_date }}</td>
                                    <td>{{ $activity->end_date}}</td>
                                    @if ($activity->pivot->observation == '')
                                    <td><span class="badge badge-primary">Ninguna</span></td>
                                    @else
                                    <td><span class="badge badge-danger">{{ $activity->pivot->observation }}</span></td>
                                    @endif
                                    <td><a href="{{ route('grupos.observar', ['grupo'=>$group->id,'actividad'=>$activity->id]) }}" class="btn btn-sm btn-primary">Observar</a></td>
                                    <td>
                                        <form action="{{ route('grupos.observar', ['grupo'=>$group->id,'actividad'=>$activity->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-secondary" type="submit">Aprobar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($diferencias as $diferencia)
                            @if ($diferencia < 0)
                            <li>Debes corregir la actividad lo antes posible. Días pasados {{ abs($diferencia) }} </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="alert alert-info">
                        <ul>
                            @foreach ($diferencias as $diferencia)
                            @if ($diferencia >= 0 and $diferencia < 7)
                            <li>Faltan {{ $diferencia }} dias para terminar la actividad, por favor presenta tus documentos lo antes posible.</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>