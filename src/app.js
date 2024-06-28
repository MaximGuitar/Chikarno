import "./js/init"
import "./scss/main.scss"
import "swiper/css";

window.addEventListener("load", () => {
    import("htmx.org").then(htmx => {
        htmx.config.scrollIntoViewOnBoost = false
    })
})