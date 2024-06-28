<div class="page-container page-container--has-bottom-offset page-<?= get_the_ID() ?>">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
    <?php get_template_part("components/breadcrumbs") ?>
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>

    <section class="calendar" x-data="CalendarMain">
        <div class="container">
            <div class="calendar__content">
                <div class="calendar__main" :class="{'active':openMod}" x-ref="calendar" id="calendar">
                    <h1 class="title">Мероприятия</h1>
                </div>
                <form x-ref="calendarForm" hx-target="#calendarDayWrapper" hx-swap="innerHTML"
                    hx-post="/wp-admin/admin-ajax.php?action=getCurDayEventAJAX" class="calendar-day__response">
                    <div class="calendar-day__wrapper" x-ref="calendarDayWrapper" id="calendarDayWrapper">
                        <?php getCurDayEvent(); ?>
                    </div>
                    <input type="hidden" name="dateField" x-ref="dateField" class="date" id="dateField">
                </form>
            </div>
        </div>
    </section>
    <?php new Content(); ?>
</div>