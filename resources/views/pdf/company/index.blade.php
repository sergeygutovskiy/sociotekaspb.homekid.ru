@extends('pdf.company.layout.index')

@section('content')

<div class="text-block">
    <h3>Краткое наименование организации</h3>
    <p>
        {{ $company->name }}
    </p>
</div>

<div class="text-block">
    <h3>Полное наименование организации</h3>
    <p>
        {{ $company->full_name }}
    </p>
</div>

<div class="text-block">
    <h3>Тип организации</h3>
    <p>
        {{ $company->organization_type->label }}
    </p>
</div>

<div class="text-block">
    <h3>Подведомственное КСП, администрации района или СО НКО</h3>
    <p>
        {{ $company->district->label }}
    </p>
</div>

<div class="text-block">
    <h3>Ссылка на официальный сайт организации</h3>
    <p>
        {{ $company->site }}
    </p>
</div>

<div class="text-block">
    <h3>Номер телефона организации</h3>
    <p>
        {{ $company->phone }}
    </p>
</div>

<div class="text-block">
    <h3>Электронная почта организации</h3>
    <p>
        {{ $company->email }}
    </p>
</div>

<div class="text-block">
    <h3>Руководитель организации</h3>
    <p>
        {{ $company->owner }}
    </p>
</div>

<div class="text-block">
    <h3>Ответственный за предоставление информации</h3>
    <p>
        {{ $company->responsible}}
    </p>
</div>

<div class="text-block">
    <h3>Телефон ответственного за предоставление информации</h3>
    <p>
        {{ $company->responsible_phone }}
    </p>
</div>

<div class="text-block">
    <h3>Наличие лицензии на осуществление образовательной деятельности</h3>
    @if ( $company->education_license )
        <dt>
            <dt>Номер лицензии</dt>
            <dd>{{ $company->education_license['number'] }}</dd>
            <dt>Дата выдачи лицензии</dt>
            <dd>{{ $company->education_license['date'] }}</dd>
            <dt>Вид деятельности</dt>
            <dd>{{ $company->education_license['type'] }}</dd>
        </dt>
    @else
        Нет
    @endif
</div>

<div class="text-block">
    <h3>Наличие лицензии на осуществление медицинской деятельности</h3>
    @if ( $company->medical_license )
        <dt>
            <dt>Номер лицензии</dt>
            <dd>{{ $company->medical_license['number'] }}</dd>
            <dt>Дата выдачи лицензии</dt>
            <dd>{{ $company->medical_license['date'] }}</dd>
        </dt>
    @else
        Нет
    @endif
</div>

<div class="text-block">
    <h3>Наличие инновационной/ресурсной площадки в организации</h3>
    <p>
        {{ $company->is_has_innovative_platform ? 'Да' : 'Нет' }}
    </p>
</div>

@endsection