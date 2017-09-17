<html>
    <head>
        <title>Calendar PHP-Vue</title>
        <link href="css/calendar.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div id="calendar">
            <div class="box">
                <div class="header">
                    <a href="javascript:void(0);" v-on:click="navigation(prev_month, prev_year)" class="prev">Prev</a>
                    <span class="title">{{ current_month }} {{ current_year }}</span>
                    <a href="javascript:void(0);" v-on:click="navigation(next_month, next_year)" class="next">Next</a>
                </div>
            </div>
            <div class="box-content">
                <ul class="label">
                    <label-day
                      v-for="day in labelDays"
                      v-bind:day="day">
                    </label-day>
                </ul>
                <div class="clear"></div>
                <ul class="dates">
                    <dates-date
                      v-for="date in dates"
                      v-bind:date="date">
                    </dates-date>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <script src="js/vue.min.js"></script>
        <script src="js/vue-resource.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>