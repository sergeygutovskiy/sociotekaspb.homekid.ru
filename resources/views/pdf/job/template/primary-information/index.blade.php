<h2>Основная информация</h2>
<div class="text-block">
    <h3>Наименование</h3>
    <p>
        {{ $social_project->job->primary_information->name }}
    </p>
</div>
<div class="text-block">
    <h3>Лучшая практика по мнению руководства организации</h3>
    <p>
        {{ $social_project->job->primary_information->is_best_practice ? 'Да' : 'Нет' }}
    </p>
</div>
<div class="text-block">
    <h3>Аннотация</h3>
    <p>
        {{ $social_project->job->primary_information->annotation }}
    </p>
</div>
<div class="text-block">
    <h3>Цель</h3>
    <p>
        {{ $social_project->job->primary_information->purpose }}
    </p>
</div>
<div class="text-block">
    <h3>Основные задачи</h3>
    <p>
        {{ $social_project->job->primary_information->objectives }}
    </p>
</div>
<div class="text-block">
    <h3>Реализация для гражданина бесплатно/платно</h3>
    <p>
        {{ $social_project->job->primary_information->payment->label }}
    </p>
</div>
<div class="text-block">
    <h3>Возможность реализации в дистанционном формате</h3>
    <p>
        {{ $social_project->job->primary_information->is_remote_format_possible ? 'Да' : 'Нет' }}
    </p>
</div>
<div class="text-block">
    <h3>Взаимодействие, партнерство с другими организациями</h3>
    <p>
        @if ($social_project->job->primary_information->partnership)
            {{ $social_project->job->primary_information->partnership['description'] }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Привлечение добровольцев и волонтеров</h3>
    <p>
        {{ $social_project->job->primary_information->volunteer->label }}
    </p>
</div>
<div class="text-block">
    <h3>Категории</h3>
    <p>
        @if ( $social_project->job->primary_information->needy_categories()->isNotEmpty() )
            {{ $social_project->job->primary_information->needy_categories()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Целевые группы</h3>
    <p>
        @if ( $social_project->job->primary_information->needy_category_target_groups()->isNotEmpty() )
            {{ $social_project->job->primary_information->needy_category_target_groups()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Форма социального обслуживания (сопровождения)</h3>
    <p>
        @if ( $social_project->job->primary_information->social_services()->isNotEmpty() )
            {{ $social_project->job->primary_information->social_services()->implode('label', ', ') }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Основные качественные результаты</h3>
    <p>
        {{ $social_project->job->primary_information->qualitative_results }}
    </p>
</div>
<div class="text-block">
    <h3>Социальные результаты</h3>
    <p>
        {{ $social_project->job->primary_information->social_results }}
    </p>
</div>
<div class="text-block">
    <h3>Апробация на инновационной площадке/в ресурсном центре</h3>
    <p>
        @if ($social_project->job->primary_information->approbation)
            {{ $social_project->job->primary_information->approbation['description'] }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Тиражируемость</h3>
    <p>
        {{ $social_project->job->primary_information->replicability ?? 'Нет' }}
    </p>
</div>
<div class="text-block">
    <h3>Видео ролик</h3>
    <p>
        {{ $social_project->job->primary_information->video ?? 'Нет' }}
    </p>
</div>
<div class="text-block">
    <h3>Наличие экспертного заключения</h3>
    <p>
        @if ($social_project->job->primary_information->expert_opinion)
            {{ $social_project->job->primary_information->expert_opinion['description'] }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наличие рецензии</h3>
    <p>
        @if ($social_project->job->primary_information->comment)
            {{ $social_project->job->primary_information->comment['description'] }}
        @else
            Нет
        @endif
    </p>
</div>
<div class="text-block">
    <h3>Наличие отзыва</h3>
    <p>
        @if ($social_project->job->primary_information->review)
            {{ $social_project->job->primary_information->review['description'] }}
        @else
            Нет
        @endif
    </p>
</div>