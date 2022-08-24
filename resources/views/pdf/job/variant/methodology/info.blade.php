<h2>Доп. информация</h2>
<div class="text-block">
    <h3>Направленность</h3>
    <p>
        {{ $methodology->direction->label }}
    </p>
</div>
<div class="text-block">
    <h3>Распространенность методики</h3>
    <p>
        {{ $methodology->prevalence->label }}
    </p>
</div>
<div class="text-block">
    <h3>Форма организации деятельности при реализации технологии/методики</h3>
    <p>
        {{ $methodology->activity_organization_form->label }}
    </p>
</div>
<div class="text-block">
    <h3>Период применения (продолжительность реализации)</h3>
    <p>
        {{ $methodology->application_period->label }}
    </p>
</div>
<div class="text-block">
    <h3>Количество реализованных полных циклов</h3>
    <p>
        {{ $methodology->realized_cycles }}
    </p>
</div>
<div class="text-block">
    <h3>Продолжительность одного цикла</h3>
    <p>
        {{ $methodology->cycle_duration }}
    </p>
</div>
<div class="text-block">
    <h3>Автор(ы) (составитель) технологии/методики, информация о согласовании (при наличии)</h3>
    <p>
        {{ $methodology->authors ?? 'Нет' }}
    </p>
</div>
<div class="text-block">
    <h3>Исследование эффективности или доказательности методики/технологии</h3>
    <p>
        {{ $methodology->effectiveness_study ?? 'Нет' }}
    </p>
</div>
<div class="text-block">
    <h3>Ссылка на сайт</h3>
    <p>
        {{ $methodology->effectiveness_study_link ?? 'Нет' }}
    </p>
</div>
