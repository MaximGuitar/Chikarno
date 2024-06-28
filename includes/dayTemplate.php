<div class="calendar-day">
    <div class="calendar-day__header">
        <div class="calendar-day__header-ofWeek">
            <?= $args['dayOfWeek'] ?>
        </div>
        <div class="calendar-day__header-curDate">
            <?= $args['date'] ?>
        </div>
    </div>
    <div class="calendar-day__content">
        <div class="img-container calendar-day__img">
            <img src="<?= $args['pic']['sizes']['medium_large'] ?>" alt="">
        </div>
        <div class="calendar-day__text content-text text-page">
            <?= $args['descr'] ?>
        </div>
    </div>
    <div class="calendar-day__btn-wrapper">
        <div class="btn" data-booking="<?= $args['fullDate'] ?>" x-data="Modal" @click="open('modal-book-table')">
            <p>Забронировать столик</p>
        </div>
        <div @click="openMod = ! openMod" class="btn btn--transperent calendar-day__mob-cal-btn" >
            <p>Выбрать дату</p>
        </div>
    </div>
</div>