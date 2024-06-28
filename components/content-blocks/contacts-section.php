<div class="footer__top-wrapper">
    <div class="container-1920">
        <div class="footer__top">
            <div class="footer__top-info-wrapper">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/neon-decor1.png" loading="lazy"
                    class="footer__top-decor">
                <div class="footer__top-content-wrapper">
                    <div class="footer__top-texts">
                        <div class="footer__top-adress">
                            <?php the_field('address', 'options'); ?>
                        </div>
                        <?php
                        $curDate = wp_date("N H:i");
                        $dayOfWeek = explode(":", $curDate)[0];
                        $workModeList = get_field("work_mode", "options");
                        $curWorkMode = $workModeList[(int) $dayOfWeek - 1];
                        $openTime = strtotime($curWorkMode['open_time']);
                        $closeTime = strtotime($curWorkMode['close_time']);
                        $curTime = strtotime(explode(" ", $curDate)[1]);
                        $isWork = $openTime >= $curTime && $curTime <= $closeTime;
                        ?>
                        <?php $workModeList = get_field("work_mode", "options"); ?>
                        <div class="footer__top-work-time-wrapper" x-data="{ openFooterTimeList: false }"
                            @click="openFooterTimeList = ! openFooterTimeList"
                            :class="{'active':openFooterTimeList}">
                            <div class="footer__top-work-time">
                                <div class="footer__top-work-time-texts">
                                    <p>Режим работы </p>
                                    <p>Сегодня <?= $curWorkMode["open_time"] ?> – <?= $curWorkMode["close_time"] ?></p>
                                </div>

                                <svg>
                                    <use href='<?= SPRITE_PATH ?>#arr-to-bottom'></use>
                                </svg>
                            </div>
                            <?php if ($workModeList): ?>
                                <div class="header__submenu work-time__list" :class="{'active':openFooterTimeList}">
                                    <ul>
                                        <?php foreach ($workModeList as $item): ?>
                                            <li>
                                                <?php if ($item["week_day"]): ?>
                                                    <div class="work-time__list-item">
                                                        <p class="work-time__weekDay">
                                                            <?= $item["week_day"] ?>
                                                        </p>
                                                        <p class="work-time__openTime">
                                                            <?= $item["open_time"] ?>-
                                                            <?= $item["close_time"] ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (get_field('tel', 'option')): ?>
                        <a href="tel:<?= get_field('tel', 'option') ?>" target="_blank" class="footer__tel">
                            <?php the_field('tel', 'option'); ?>
                        </a>
                    <?php endif ?>

                    <div class="btn footer__top-btn ">
                        <p>Бронь стола</p>
                    </div>
                    <div class="messangers">
                        <?php if (get_field('tg_link', 'option')): ?>
                            <a href="<?= get_field('tg_link', 'option') ?>" class="messangers__icon">
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/tg.png" alt="">
                            </a>
                        <?php endif; ?>
                        <?php if (get_field('tg_link', 'option')): ?>
                            <a href="<?= get_field('tg_link', 'option') ?>" class="messangers__icon">
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/insta.png" alt="">
                            </a>
                        <?php endif; ?>
                        <?php if (get_field('tg_link', 'option')): ?>
                            <a href="<?= get_field('tg_link', 'option') ?>" class="messangers__icon">
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/vkLogo.png" alt="">
                            </a>
                        <?php endif; ?>
                        <?php if (get_field('tg_link', 'option')): ?>
                            <a href="<?= get_field('tg_link', 'option') ?>" class="messangers__icon">
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/whats.png" alt="">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="footer__top-menu">
                    <?php $menuArr = (wp_get_menu_array('menuAllLinks')); ?>
                    <ul>
                        <?php foreach ($menuArr as $item): ?>
                            <li>
                                <a href="<?= $item["href"] ?>">
                                    <?= $item["title"] ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div
                class="footer__top-map"
                x-data="contactsMap"
                x-intersect:enter.once="initMap(<?= the_field('shirota', 'option'); ?>,<?= the_field('dolgota', 'option'); ?>, 15)"
            >
            </div>
        </div>
    </div>
</div>