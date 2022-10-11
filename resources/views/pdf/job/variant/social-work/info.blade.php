<h2>Доп. информация</h2>
<div class="text-block">
    <h3>Вид программы</h3>
    <p>
        {{ $social_work->program_type->label }}
    </p>
</div>
<div class="text-block">
    <h3>Направленность</h3>
    <p>
        {{ $social_work->direction->label }}
    </p>
</div>
<div class="text-block">
    <h3>Форма проведения занятий</h3>
    <p>
        {{ $social_work->conducting_classes_form->label }}
    </p>
</div>
<div class="text-block">
    <h3>Вид услуги</h3>
    <p>
        @if ( $social_work->service_types()->isNotEmpty() )
            {{ $social_work->service_types()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наименование услуги</h3>
    <p>
        @if ( $social_work->service_names()->isNotEmpty() )
            {{ $social_work->service_names()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наименование государственной работы</h3>
    <p>
        @if ( $social_work->public_works()->isNotEmpty() )
            {{ $social_work->public_works()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
