import Map from "../Map";

export default () => ({
    async initMap(lon,lat, zoom = 15) {
        await Map.loadAPI();
        
        const {default: MapCustomization} = await import("../MapGarbage.json");

        const map = new Map({
            container: this.$root,
            center: [lon, lat],
            zoom,
            customization: MapCustomization
        });
        map.addMarker([lon, lat], Map.createCustomMarker())
    }
});
