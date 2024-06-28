import Alpine from "alpinejs";
import mask from '@alpinejs/mask';
import intersect from '@alpinejs/intersect'
 

//Регистрация функций alpine
import simpleSlider from "./alpine/simpleSlider.js";
import slowScroll from "./alpine/slowScroll.js";
import contactsMap from "./alpine/contactsMap.js";
import mainSlider from "./alpine/mainSlider.js";
import aboutUsSlider from "./alpine/aboutUsSlider.js";
import CalendarMain from "./alpine/CalendarMain.js";
import simpleCalendar from "./alpine/simpleCalendar.js";
import CustomScrollbar from "./alpine/CustomScrollbar.js";
import FancyboxGallery from "./alpine/FancyboxGallery"
import Modal from "@/components/Modal"

Alpine.plugin(mask);
Alpine.plugin(intersect)

Alpine.data('slowScroll', slowScroll);
Alpine.data('simpleSlider', simpleSlider);
Alpine.data('contactsMap', contactsMap);
Alpine.data('mainSlider', mainSlider);
Alpine.data('CalendarMain', CalendarMain);
Alpine.data('aboutUsSlider', aboutUsSlider);
Alpine.data('simpleCalendar', simpleCalendar);
Alpine.data('CustomScrollbar', CustomScrollbar);
Alpine.data('FancyboxGallery', FancyboxGallery)
Alpine.data('Modal', Modal)

Alpine.store('basket', {
    open: false
});

Alpine.start()



//Формат числа
window.number_format = (number, decimals, dec_point, thousands_sep) => {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}