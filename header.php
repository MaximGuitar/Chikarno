<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
	
	<script>
		window.ajaxUrl = '/wp-admin/admin-ajax.php';
		window.templateUrl = '<?php bloginfo('template_url'); ?>';
	</script>
</head>
<?php
	use Placestart\Shop\Cart;
	
	$cart = new Cart();
	$cart_items = $cart->getCartItems();
?>
<body>
	<div class="page-wrapper">
		<header class="header" x-data="{ openMobMenu: false }">
			<div class="container">
				<div class="header__wrapper">
					<a href="/" class="header__logo">
						<svg>
							<use href='<?= SPRITE_PATH ?>#static-logo'>
							</use>
						</svg>
					</a>
					<a href="/" class="header__mob-logo">
						<svg>
							<use href='<?= SPRITE_PATH ?>#static-mobLogo'>
							</use>
						</svg>
					</a>

					<nav class="header__menu">
						<?php $menuArr = (wp_get_menu_array('headerMenu')); ?>
						<ul class="header__menu-list">
							<?php foreach ($menuArr as $item): ?>
								<li class="header__menu-list-item-wrapper">
									<div class="header__menu-list-item">
										<a href="<?= $item["href"] ?>"><?= $item['title'] ?></a>
										<?php if ($item["children"]): ?>
											<svg class="">
												<use href='<?= SPRITE_PATH ?>#arr-to-bottom'>
												</use>
											</svg>
										<?php endif; ?>
									</div>
									<?php if ($item["children"]): ?>
										<div class="header__submenu">
											<ul>
												<?php foreach ($item["children"] as $subItem): ?>
													<li>
														<a href="<?= $subItem["href"] ?>"><?= $subItem["title"] ?></a>
													</li>
												<?php endforeach ?>
											</ul>
										</div>
									<?php endif; ?>

								</li>
							<?php endforeach ?>
						</ul>
						<div href="#" @click="openMobMenu = ! openMobMenu" :class="{'active':openMobMenu}"
							class="header__menu-open only-desktop">
							<svg>
								<use href='<?= SPRITE_PATH ?>#openMenu'></use>
							</svg>
						</div>
					</nav>
					<div class="header__info">
						<div class="work-time">
							<?php
							$curDate = wp_date("N H:i");
							$dayOfWeek = explode(":", $curDate)[0];
							$workModeList = get_field("work_mode", "options");
							$curWorkMode = $workModeList[(int) $dayOfWeek - 1];
							$openTime = strtotime($curWorkMode['open_time']);
							$closeTime = strtotime($curWorkMode['close_time'] . ' +1 day');
							$curTime = strtotime(explode(" ", $curDate)[1]);
							$isWork = ($curTime >= $openTime) && ($curTime <= $closeTime);
							?>
							<?php if (get_field('tel', 'option')): ?>
								<a href="tel:<?php the_field('tel', 'option'); ?>"
									class="work-time__number"><?php the_field('tel', 'option'); ?></a>
							<?php endif; ?>
							<div class="work-time__cur-wrapper" x-data="{ openTimeList: false }">
								<div
									class="work-time__cur"
									@click="openTimeList = ! openTimeList"
									@click.outside="openTimeList = false"
									@keyup.escape.window="openTimeList = false"
									:class="{'active':openTimeList}"
								>
									<div
										class="work-time__cur-indicator <?= !$isWork ? "work-time__cur-indicator--red" : "" ?>">
									</div>
									<div class="work-time__text">
										<p>
											<?php if ($curTime <= $openTime): ?>
												Закрыты до <?= $curWorkMode["open_time"] ?>
											<?php elseif ($curTime <= $closeTime): ?>
												Открыты до <?= $curWorkMode["close_time"] ?>
											<?php else: ?>
												Закрыты до <?= $curWorkMode["open_time"] ?>
											<?php endif; ?>
										</p>
									</div>
									<svg class="work-time__showMore">
										<use href='<?= SPRITE_PATH ?>#arr-to-bottom'></use>
									</svg>
								</div>
								<?php if ($workModeList): ?>
									<div class="header__submenu work-time__list" :class="{'active':openTimeList}">
										<ul>
											<?php foreach ($workModeList as $item): ?>
												<li>
													<?php if ($item["week_day"]): ?>
														<div class="work-time__list-item">
															<p class="work-time__weekDay">
																<?= $item["week_day"] ?>
															</p>
															<p class="work-time__openTime">
																<?= $item["open_time"] ?>-<?= $item["close_time"] ?>
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
						<div class="btn header__info-btn" x-data="Modal" @click="open('modal-book-table')">
							<p>резерв стола</p>
						</div>
						<?php if (get_field('tg_link', 'option')): ?>
							<a href="<?= get_field('tg_link', 'option') ?>" class="header__tg" target="_blank">
								<img src="<?= get_bloginfo('template_url') ?>/static/images/tg.png" alt="tg">
							</a>
						<?php endif; ?>
						<div class="mobile-basket-btn" x-data @click="$store.basket.open = true">
							<svg class="icon">
								<use href='<?= SPRITE_PATH ?>#cart'>
								</use>
							</svg>
							<div class="count"><?php get_template_part("components/cart/total-cart-count", null, ["count" => count($cart_items) ]) ?></div>
						</div>
						<div class="btn btn--dark basket-btn" x-data @click="$store.basket.open = true">
							<svg class="basket-btn__cart">
								<use href='<?= SPRITE_PATH ?>#cart'>
								</use>
							</svg>
							<div class="basket-btn__price">
								<?php get_template_part("components/cart/total-cart-price", null, [
									"price" => $cart->getTotalPrice()
								]) ?>
							</div>
						</div>
						<div href="#" class="header__menu-open only-mobile" @click="openMobMenu = ! openMobMenu"
							:class="{'active':openMobMenu}">
							<svg>
								<use href='<?= SPRITE_PATH ?>#openMenu'></use>
							</svg>
						</div>
					</div>
				</div>
			</div>
			<div class="header__menu-wrapper" :class="{'active':openMobMenu}">
				<div class="header__mobile-menu-wrapper" :class="{'active':openMobMenu}">
					<?php $menuArrDesc = (wp_get_menu_array('menuAllLinks')); ?>
					<div class="header__mobile-menu-desc">
						<ul>
							<?php foreach ($menuArrDesc as $item): ?>
								<li>
									<a href="<?= $item["href"] ?>">
										<?= $item["title"] ?>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
					<div class="mobile-menu container">
						<button class="close-modal" @click="openMobMenu = false">
							<svg class="icon">
								<use href="<?= SPRITE_PATH ?>#close"></use>
							</svg>
						</button>
						<ul class="mobile-menu__menu-list">
							<?php foreach ($menuArr as $item): ?>
								<li class="mobile-menu__menu-list-item-wrapper">
									<div class="mobile-menu__menu-list-item">
										<a href="<?= $item["href"] ?>"><?= $item['title'] ?></a>
									</div>
									<?php if ($item["children"]): ?>
										<div class="mobile-menu__submenu">
											<ul>
												<?php foreach ($item["children"] as $subItem): ?>
													<li>
														<a href="<?= $subItem["href"] ?>"><?= $subItem["title"] ?></a>
													</li>
												<?php endforeach ?>
											</ul>
										</div>
									<?php endif; ?>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<main>