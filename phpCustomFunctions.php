<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Placestart\Shop\CartAjaxApi;
use Placestart\Shop\OrderAjaxApi;
use Placestart\Utils\Mailer;
use Valitron\Validator;

define("DEFAULT_CART_ID", "TEST_CART");

/**
 * Функция для кастомного построения меню
 * @param mixed $current_menu name меню в админке
 * @return mixed массив с деревом уровней меню
 */
function wp_get_menu_array($current_menu)
{
    $array_menus = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menus as $key => $array_menu) {
        $array_menus[$key]->current = false;
        $classes = (array) $array_menu->classes;
        $classes[] = 'menu-item';
        $classes[] = 'menu-item-type-' . $array_menu->type;
        $classes[] = 'menu-item-object-' . $array_menu->object;
        $array_menus[$key]->classes = array_unique($classes);
        if (empty($array_menu->menu_item_parent)) {
            $current_id = $array_menu->ID;
            $menu[$current_id] = array(
                'id' => $current_id,
                'title' => $array_menu->title,
                'href' => $array_menu->url,
                'classes' => $array_menu->classes,
                'children' => array()
            );
        }
        if (isset($current_id) && $current_id == $array_menu->menu_item_parent) {
            $submenu_id = $array_menu->ID;
            $menu[$current_id]['children'][$array_menu->ID] = array(
                'id' => $submenu_id,
                'title' => $array_menu->title,
                'href' => $array_menu->url,
                'img' => get_field('category_img', 'catalog_' . $array_menu->object_id),
                'classes' => $array_menu->classes,
                'children' => array()
            );
        }
        if (isset($submenu_id) && $submenu_id == $array_menu->menu_item_parent) {
            $menu[$current_id]['children'][$submenu_id]['children'][$array_menu->ID] = array(
                'id' => $array_menu->ID,
                'title' => $array_menu->title,
                'href' => $array_menu->url,
                'classes' => $array_menu->classes,
            );
        }
    }
    return $menu;
}

// Хуки на форму
new CartAjaxApi();
new OrderAjaxApi();


add_action('wp_ajax_book_table', 'bookTable');
add_action('wp_ajax_nopriv_book_table', 'bookTable');

function bookTable(){
    $result = array_merge([
        "status" => "success",
    ], $_REQUEST);

    $v = new Validator($_REQUEST);
    $v->rule('required', ['date', 'time', 'fio', 'tel']);
    $v->setPrependLabels(false);
    if (!$v->validate()){
        $result['status'] = 'not_valid';
        $result['errors'] = $v->errors();

        get_template_part("components/book-table-form", null, $result);
        wp_die();
    }

    $mailer = new Mailer("Заявка на бронирование стола", return_template_part("components/mail/footer-book-table", null, [
        "date" => $_REQUEST["date"],
        "time" => $_REQUEST["time"],
        "fio" => $_REQUEST["fio"],
        "tel" => $_REQUEST["tel"],
        "comment" => $_REQUEST["comment"],
    ]));
    $mail_result = $mailer->send();
    
    if ($mail_result["status"] == "error"){
        $result["status"] = "mail_error";
        $result["error"] = $mail_result['error'];
    }

    get_template_part("components/book-table-form", null, $result);
    wp_die();
}

function get_post_thumb($postID, $size = 'thumbnail')
{
	$img_id = get_post_thumbnail_id($postID);
	$img_url = get_the_post_thumbnail_url($postID, $size);
	if (!$img_url)
		return null;

	$img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

	return ['src' => $img_url, 'alt' => $img_alt];
}

function return_template_part( string $slug, string $name = null, array $args = [] ): string 
{
    ob_start();
    get_template_part($slug, $name, $args);
    return ob_get_clean();
}

// Хуки
function getCurDayEvent()
{
    if (isset($_POST['dateField'])) {
        $selectedDate = (date("d.m.Y N", strtotime($_POST['dateField'])));
    } else {
        $selectedDate = (date("d.m.Y N"));
    }
    $days = [
      1 =>'Понедельник',
      2 =>  'Вторник',
      3 =>  'Среда',
      4 =>  'Четверг',
      5 =>  'Пятница',
      6 => 'Суббота',
      7 =>  'Воскресенье'
    ];

    $selectedDate = explode(' ', $selectedDate);
    $dayOfWeek = $days[$selectedDate[1]];
    $formatDate = (date("d.m", strtotime($selectedDate[0])));
    $isSpecial = false;

    $specialDays = get_posts(
        array(
            'numberposts' => -1,
            'category' => 11,
            'post_type' => 'post',
        )
    );
    $defaultDays = get_posts(
        array(
            'numberposts' => -1,
            'category' => 10,
            'post_type' => 'post',
        )
    );

    foreach ($specialDays as $item) {
        if (get_field('special-day_date', $item->ID) === $selectedDate[0]) {
            $descr = get_field('special-day_descr', $item->ID);
            $pic = get_field('special-day_pic', $item->ID);
            $isSpecial = true;
            break;
        }
    }
    if (!$isSpecial) {
        foreach ($defaultDays as $item) {
            if ($item->post_title === $dayOfWeek) {
                $descr = get_field('default-day_descr', $item->ID);
                $pic = get_field('default-day_pic', $item->ID);
                break;
            }
        }
    }

    $args = [
        'date' => $formatDate,
        'descr' => $descr,
        'pic' =>  $pic,
        'dayOfWeek' => $dayOfWeek,
        'fullDate' => $selectedDate[0],
    ];

    get_template_part('/includes/dayTemplate',null, $args);
}

add_action('wp_ajax_getCurDayEventAJAX', 'getCurDayEventAJAX');
add_action('wp_ajax_nopriv_getCurDayEventAJAX', 'getCurDayEventAJAX');

function getCurDayEventAJAX()
{
    getCurDayEvent();
    wp_die();
}