export default class Map {
    constructor({ container, center, zoom, customization }) {
        if (!container) throw new Error("Контейнер не определён")

        this.container = container
        this.customization = customization
        this.createMap(center, zoom)
    }

    static key = "ca4ab438-ce96-431f-9eb5-8441c2a35bb3"
    static ymapIsReady = false
    static isLoading = false

    static loadAPI() {
        if (!this.isLoading && !this.ymapIsReady) {
            this.loader = this.startLoad()
            return this.loader
        } else return this.loader
    }

    static startLoad() {
        return new Promise(resolve => {
            this.isLoading = true
            if (Map.ymapIsReady) {
                this.isLoading = false
                resolve("loaded")
                return
            }

            const script = document.createElement("script")
            script.src = `https://api-maps.yandex.ru/v3/?apikey=${this.key}&lang=ru_RU`
            script.addEventListener("load", async () => {
                await ymaps3.ready
                Map.ymapIsReady = true
                this.isLoading = false
                resolve("loaded")
            })
            document.body.append(script)
        })
    }

    static createCustomMarker() {
        const marker = document.createElement("div")
        marker.innerHTML = `
        <svg width="39" height="54" viewBox="0 0 39 54" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M39 19.5C39 36.2696 19.5 54 19.5 54C19.5 54 0 36.2696 0 19.5C0 8.73045 8.73045 0 19.5 0C30.2696 0 39 8.73045 39 19.5Z" fill="#F92E6E"/>
        <path d="M30.0625 19.3433C30.0625 25.1299 25.3335 29.8209 19.5 29.8209C13.6665 29.8209 8.9375 25.1299 8.9375 19.3433C8.9375 13.5567 13.6665 8.86567 19.5 8.86567C25.3335 8.86567 30.0625 13.5567 30.0625 19.3433Z" fill="white"/>
        </svg>`
        marker.className = "custom-map-marker"

        return marker
    }

    createMap(center = [37.617635, 55.755814], zoom = 16) {
        this.ymap = new ymaps3.YMap(
            this.container,
            {
                location: {
                    center,
                    zoom
                }
            },
            [
                new ymaps3.YMapDefaultSchemeLayer({
                    customization: this.customization
                }),
                new ymaps3.YMapDefaultFeaturesLayer({ zIndex: 1800 })
            ]
        )
    }

    setLocation(center, zoom = 16) {
        if (!this.ymap) return

        this.ymap?.setLocation({
            center,
            zoom
        })
    }

    async addDefaultMarker(coordinates) {
        const { YMapDefaultMarker } = await ymaps3.import(
            "@yandex/ymaps3-markers@0.0.1"
        )
        this.ymap?.addChild(
            new YMapDefaultMarker({
                coordinates
            })
        )
    }

    addMarker(coordinates, content, props) {
        if (!this.ymap) return

        const marker = new ymaps3.YMapMarker(
            {
                coordinates,
                draggable: false,
                ...props
            },
            content
        )

        this.ymap.addChild(marker)
    }

    addMarkers(coordinates, content) {
        coordinates.forEach(coords => {
            this.addMarker(coords, content(coords))
        })
    }
}
