@extends('layouts.layout')

@section('content')
    <h3>Editar cliente</h3>
    @include('admin.form._form_errors')
    {{ Form::model($client,['route' => ['clients.update', $client->id], 'method' => 'PUT' ]) }}
        @include('admin.clients._form')
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
    {{ Form::close() }}
@endsection