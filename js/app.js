Vue.component('label-day', {
    props: ['day'],
    template: '<li>{{ day }}</li>'
})

Vue.component('dates-date', {
    props: ['date'],
    template: '<li>{{ date }}</li>'
})

var app = new Vue({
    el: '#calendar',
    data: {
        labelDays: [],
        dates: [],
        current_month: '',
        current_year: '',
        prev_month: '',
        prev_year: '',
        next_month: '',
        next_year: '',
    },
    methods: {
        getDataContent: function(month, year) {
            this.$http.get('Calendar.php', {params: {year:year, month:month}}).then(response => {
                this.labelDays = response.body.labels;
                this.dates = response.body.dates;
                this.current_month = response.body.navigation.current_navigation.month;
                this.current_year = response.body.navigation.current_navigation.year;
                this.prev_month = response.body.navigation.prev_navigation.month;
                this.prev_year = response.body.navigation.prev_navigation.year;
                this.next_month = response.body.navigation.next_navigation.month;
                this.next_year = response.body.navigation.next_navigation.year;
            });
        },
        navigation: function (month, year) {
            this.getDataContent(month, year);
        },
    }
})

app.getDataContent();