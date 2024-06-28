<?php

get_header();


if( is_page( 138 ) ): get_template_part('components/pages/contacts');
elseif( is_page(199) ): get_template_part('components/pages/about');
elseif( is_page(210) ): get_template_part('components/pages/reviews');
elseif( is_page(220) ): get_template_part('components/pages/events');
elseif( is_page(214) ): get_template_part('components/pages/menu');
elseif( is_page(216) ): get_template_part('components/pages/delivery');
elseif( is_page(204) ): get_template_part('components/pages/gallery');
elseif( is_page(206) ): get_template_part('components/pages/loyalty-program');
elseif( is_page(222) ): get_template_part('components/pages/banquets');
elseif( is_page(669) ): get_template_part('components/pages/order');
elseif( is_page(144) ): get_template_part('components/pages/obrabotka');
else: get_template_part('components/pages/text'); // Текстовая страница
endif;


get_footer();
