export default (perPage = 1, between = 30, speed = 900) => ({
    async init() {
        const { default: Swiper } = await import("@/js/Swiper")
        
        new Swiper(this.$refs.swiper, {
            slidesPerView: perPage,
            spaceBetween: between,
            centeredSlides: true,
            slidesPerView: 6,
             loop: true,
            autoplay: {
                delay: 900,
            },
            breakpoints: {
                320: {
                    spaceBetween: 15,
                    slidesPerView: 1
                },
                480: {
                    spaceBetween: 20,
                    slidesPerView: 3
                },
                900: {
                    spaceBetween: 40,
                    slidesPerView: 3
                },
                1200: {
                    spaceBetween: 30,
                    slidesPerView: 5
                }
            },
            navigation: {
                prevEl: this.$refs.prev,
                nextEl: this.$refs.next,
            },
        });
    },
});