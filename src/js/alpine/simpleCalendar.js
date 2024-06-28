import AirDatepicker from 'air-datepicker';

export default (inline = true, view = 'days', minView ='days',dateFormat="d.m.Y" ) => ({
    async init() {
        new AirDatepicker(this.$refs.SimpleCal, {
            selectedDates: [new Date()],
            inline: inline,
            view: view,
            minView: minView,
            showOtherMonths: false,
            selectOtherMonths: false,
            dateFormat: dateFormat,
            altFieldDateFormat: 'd',          
        });
    },
})
