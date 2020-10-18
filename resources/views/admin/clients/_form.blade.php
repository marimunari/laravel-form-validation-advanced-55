@php
    use App\Client;
@endphp

{{ Form::hidden('clientType', $clientType) }}

@component('admin.form._form_group', ['field' => 'name'])
    {{ Form::label('name', 'Nome', ['class' => 'control-label']) }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
@endcomponent

@component('admin.form._form_group', ['field' => 'document'])
    {{ Form::label('document', 'Documento', ['class' => 'control-label']) }}
    {{ Form::text('document', null, ['class' => 'form-control']) }}
@endcomponent

@component('admin.form._form_group', ['field' => 'email'])
    {{ Form::label('email', 'E-mail', ['class' => 'control-label']) }}
    {{ Form::email('email', null, ['class' => 'form-control']) }}
@endcomponent

@component('admin.form._form_group', ['field' => 'phone'])
    {{ Form::label('phone', 'Telefone', ['class' => 'control-label']) }}
    {{ Form::text('phone', null, ['class' => 'form-control']) }}
@endcomponent

@if($clientType == Client::TYPE_INDIVIDUAL)
    @component('admin.form._form_group', ['field' => 'maritalStatus'])
            {{ Form::label('maritalStatus', 'Estado Civil', ['class' => 'control-label']) }}
            {{
            Form::select('maritalStatus',[
                '' => 'Selecione o estado civil', 
                1 => 'Solteiro', 
                2 => 'Casado', 
                3 => 'Divorciado'
                ], null, ['class' => 'form-control'])
            }}
    @endcomponent
    
    @component('admin.form._form_group', ['field' => 'dateBirth'])
        {{ Form::label('dateBirth', 'Data de Nascimento', ['class' => 'control-label']) }}
        {{ Form::date('dateBirth', null, ['class' => 'form-control']) }}
    @endcomponent

    @php
        $gender = $client->gender;
    @endphp
    <div class="form-group">
        {{ Form::label('gender', 'Gênero') }}
        <div class="radio{{ $errors->has('gender') ? ' has-error': ''}}">
            <label>
                {{ Form::radio('gender', 'm') }} Masculino
            </label>
        </div>
        <div class="radio{{ $errors->has('gender') ? ' has-error': ''}}">
            <label>
                {{ Form::radio('gender', 'f') }} Feminino
            </label>
        </div>
    </div>

    <div class="{{ $errors->has('gender') ? ' has-error': ''}}">
        @include('admin.form._help_block', ['field' => 'gender'])
    </div>

    @component('admin.form._form_group', ['field' => 'physicalDisability'])
        {{ Form::label('physicalDisability', 'Deficiência Física', ['class' => 'control-label']) }}
        {{ Form::text('physicalDisability', null, ['class' => 'form-control']) }}
    @endcomponent
@else
    @component('admin.form._form_group', ['field' => 'companyName'])
        {{ Form::label('companyName', 'Nome Fantasia', ['class' => 'control-label']) }}
        {{ Form::text('companyName', null, ['class' => 'form-control']) }}
    @endcomponent
@endif
@php
    $defaulter = $client->defaulter;
@endphp
<div class="checkbox">
<label>
    {{ Form::checkbox('defaulter', 1) }} Inadimplente?
</label>
</div>
