@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$titulo}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ empty($tarefa->id)? route('tarefa.store') : route('tarefa.update',['tarefa' => $tarefa->id]) }}">
                        @csrf
                        @if(!empty($tarefa->id))
                            @method("PUT")
                        @endif
                        <input type="hidden" name="id" value="{{ $tarefa->id }}">
                        <div class="mb-3">
                            <label class="form-label">Tarefa</label>
                            <input type="text" class="form-control" name="tarefa" value="{{ $tarefa->tarefa }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data limite conclusão</label>
                            <input type="date" class="form-control" name="data_limite_conclusao" value="{{ $tarefa->data_limite_conclusao }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
