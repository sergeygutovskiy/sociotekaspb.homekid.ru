<h2>Доп. информация</h2>
<div class="text-block">
    <h3>Форма проведения занятий</h3>
    <p>
        {{ $club->conducting_classes_form->label }}
    </p>
</div>
<div class="text-block">
    <h3>График</h3>
    <p>
        {{ $club->schedule }}
    </p>
</div>
<div class="text-block">
    <h3>Вид услуги</h3>
    <p>
        @if ( $club->service_types()->isNotEmpty() )
            {{ $club->service_types()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наименование услуги</h3>
    <p>
        @if ( $club->service_names()->isNotEmpty() )
            {{ $club->service_names()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наименование государственной работы</h3>
    <p>
        @if ( $club->public_works()->isNotEmpty() )
            {{ $club->public_works()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>