<h2>Доп. информация</h2>
<div class="text-block">
    <h3>Вы участник, а не организатор?</h3>
    <p>
        @if ($social_project->participant)
            Да. Организаторы:
            {{ $social_project->participant['description'] }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Период реализации проекта</h3>
    <p>
        {{ $social_project->implementation_period }}
    </p>
</div>
<div class="text-block">
    <h3>Уровень реализации проекта</h3>
    <p>
        {{ $social_project->implementation_level->label }}
    </p>
</div>
<div class="text-block">
    <h3>Вид услуги</h3>
    <p>
        @if ( $social_project->service_types()->isNotEmpty() )
            {{ $social_project->service_types()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наименование услуги</h3>
    <p>
        @if ( $social_project->service_names()->isNotEmpty() )
            {{ $social_project->service_names()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наименование государственной работы</h3>
    <p>
        @if ( $social_project->public_works()->isNotEmpty() )
            {{ $social_project->public_works()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Обстоятельства признания нуждаемости</h3>
    <p>
        @if ( $social_project->need_recognitions()->isNotEmpty() )
            {{ $social_project->need_recognitions()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
