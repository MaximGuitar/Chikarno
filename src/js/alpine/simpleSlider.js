export default (perPage = 1, between = 30, speed = 900) => ({
    async init() {
        const { default: Swiper } = await import("@/js/Swiper")
        new Swiper(this.$refs.swiper, {

            slidesPerView: perPage,
            loop: true,
            spaceBetween: between,
            slidesPerView: 1,

            navigation: {
                prevEl: this.$refs.prev,
                nextEl: this.$refs.next,
            },
            pagination: {
                el: this.$refs.pag,
                type: "fraction",
            },
        });
    },
});