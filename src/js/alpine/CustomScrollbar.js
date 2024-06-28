export default () => ({
    async init() {
        await import("overlayscrollbars/overlayscrollbars.css");
        const { OverlayScrollbars } = await import("overlayscrollbars");

        OverlayScrollbars(
            {
                target: this.$refs.container,
                scrollbars: {
                    slot: this.$root,
                },
            },
            {
                overflow: {
                    x: "hidden",
                },
                scrollbars: {
                    theme: "",
                },
            }
        );
    },
});
