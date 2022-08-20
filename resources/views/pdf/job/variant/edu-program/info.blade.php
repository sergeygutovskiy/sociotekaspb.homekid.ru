<h2>Доп. информация</h2>
<div class="text-block">
    <h3>Направленность</h3>
    <p>
        {{ $edu_program->direction->label }}
    </p>
</div>
<div class="text-block">
    <h3>Форма проведения занятий</h3>
    <p>
        {{ $edu_program->conducting_classes_form->label }}
    </p>
</div>
<div class="text-block">
    <h3>Сроки, режим занятий</h3>
    <p>
        {{ $edu_program->dates_and_mode_of_study }}
    </p>
</div>
