<section class="calendar" x-data="CalendarMain">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="calendar__bg">
    <div class="container">
        <div class="calendar__content">
            <div class="calendar__main" :class="{'active':openMod}"  x-ref="calendar" id="calendar">

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