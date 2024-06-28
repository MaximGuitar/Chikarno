import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';

export default () => ({
    openMod:false,
    async init() {
        // import('air-datepicker/air-datepicker.css')
        new AirDatepicker(this.$refs.calendar, {
            selectedDates: [new Date()],
            inline: true,
            view: 'days',
            minView: 'days',
            showOtherMonths: false,
            selectOtherMonths: false,
            dateFormat: 'd',
            altFieldDateFormat: 'd',
            onSelect: ({ date, datepicker }) => {
                let event = new Event("submit", { bubbles: true, cancelable: true })
                let day = date.getDate();
                let monthIndex = date.getMonth()+1;
                let year = date.getFullYear();
                let formattedDate = day + "." + monthIndex + "." + year;
                this.$refs.dateField.value = formattedDate;
                this.$refs.calendarForm.dispatchEvent(event);
                this.openMod =false;
            },
        });
    },
})
