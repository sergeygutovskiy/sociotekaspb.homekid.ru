<h2>Опыт</h2>
<div class="text-block">
    <h3>Описание результатов в виде статьи, опубликованной в сборнике, журнале</h3>
    @if ( $experience->results_in_journal )
        <dl>
            <div>
                <dt>Описание</dt>
                <dd>{{ $experience->results_in_journal['description'] ?? 'Нет' }}</dd>
            </div>
            <div>
                <dt>Ссылка</dt>
                <dd>{{ $experience->results_in_journal['link'] ?? 'Нет' }}</dd>
            </div>
        </dl>
    @else
        <p>Нет</p>
    @endif
</div>
<div class="text-block">
    <h3>Представление результатов на мероприятиях различного уровня</h3>
    @if ( $experience->results_of_various_events )
        <dl>
            <div>
                <dt>Описание</dt>
                <dd>{{ $experience->results_of_various_events['description'] ?? 'Нет' }}</dd>
            </div>
            <div>
                <dt>Ссылка</dt>
                <dd>{{ $experience->results_of_various_events['link'] ?? 'Нет' }}</dd>
            </div>
        </dl>
    @else
        <p>Нет</p>
    @endif
</div>
<div class="text-block">
    <h3>Представление информации о результатах на сайте организации</h3>
    @if ( $experience->results_info_in_site )
        <dl>
            <div>
                <dt>Описание</dt>
                <dd>{{ $experience->results_info_in_site['description'] ?? 'Нет' }}</dd>
            </div>
            <div>
                <dt>Ссылка</dt>
                <dd>{{ $experience->results_info_in_site['link'] ?? 'Нет' }}</dd>
            </div>
        </dl>
    @else
        <p>Нет</p>
    @endif
</div>
<div class="text-block">
    <h3>Представление информации о результатах в СМИ</h3>
    @if ( $experience->results_info_in_media )
        <dl>
            <div>
                <dt>Описание</dt>
                <dd>{{ $experience->results_info_in_media['description'] ?? 'Нет' }}</dd>
            </div>
            <div>
                <dt>Ссылка</dt>
                <dd>{{ $experience->results_info_in_media['link'] ?? 'Нет' }}</dd>
            </div>
        </dl>
    @else
        <p>Нет</p>
    @endif
</div>
<div class="text-block">
    <h3>Проведение мастер-классов (семинаров) по результатам</h3>
    @if ( $experience->results_seminars )
        <dl>
            <div>
                <dt>Описание</dt>
                <dd>{{ $experience->results_seminars['description'] ?? 'Нет' }}</dd>
            </div>
            <div>
                <dt>Ссылка</dt>
                <dd>{{ $experience->results_seminars['link'] ?? 'Нет' }}</dd>
            </div>
        </dl>
    @else
        <p>Нет</p>
    @endif
</div>
