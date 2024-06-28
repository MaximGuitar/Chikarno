export default () => ({
    slowScroll(ElemID) {
        const element = document.getElementById(ElemID);
        const offset = element?.getBoundingClientRect().top + window.pageYOffset - 180;
        window.scrollTo({
            top: offset,
            behavior: 'smooth',
        });
    },
})