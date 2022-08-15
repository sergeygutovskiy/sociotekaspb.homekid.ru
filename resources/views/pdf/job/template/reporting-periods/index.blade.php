<h2>Отчетные периоды</h2>
@foreach ($social_project->job->reporting_periods as $reporting_period)
    <h3>{{ $reporting_period->year }}</h3>
    <div>
        <div>Общее количество участников за отчетный период: <span>{{ $reporting_period->total }}</span></div>
        <div>Количество семей: <span>{{ $reporting_period->families ?? 'Нет' }}</span></div>
        <div>Количество детей: <span>{{ $reporting_period->children ?? 'Нет' }}</span></div>
        <div>Количество мужчин: <span>{{ $reporting_period->men ?? 'Нет' }}</span></div>
        <div>Количество женщин: <span>{{ $reporting_period->women ?? 'Нет' }}</span></div>
    </div>
@endforeach
