export default (perPage = 1, between = 40, speed = 900) => ({
    async init() {
        const { default: Swiper } = await import("@/js/Swiper")
        new Swiper(this.$refs.swiper, {

            slidesPerView: perPage,
            loop: true,
            spaceBetween: between,
            centeredSlides: true,
            slidesPerView: 3,
            breakpoints: {
                320: {
                    spaceBetween: 14,
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 1,
                },
                640: {
                    spaceBetween: 40,
                    slidesPerView: 3,
                }
            },
            navigation: {
                prevEl: this.$refs.prev,
                nextEl: this.$refs.next,
            },
        });
    },
});