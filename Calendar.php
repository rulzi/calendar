<?php

class Calendar {
    
    private $dayLabels = ["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"];
    private $currentMonth;

    public function __construct($month = null, $year = null){
        if($year && $month){
            $date = New \DateTime($year.'-'.$month);
        } else {
            $date = New \DateTime();
        }

        $this->currentMonth = $date;
    }

    public function show() {
        $navigation = $this->getnavigation();
        $labels = $this->dayLabels;
        $dates = $this->getDates();

        $content = [
            'navigation' => $navigation,
            'labels' => $labels,
            'dates' => $dates,
        ];

        return $content;
    }

    private function getDates()
    {
        $propertyMonth = $this->getPropertyMonth(); 
        $weeks = $propertyMonth['weeks'];
        $startDay = $propertyMonth['start_day'];
        $endDay = $propertyMonth['end_day'];

        $dates = [];

        $date = 1;
        for($week = 1; $week <= $weeks; $week++){
            for($day=1 ;$day<=7; $day++){
                $numberDate = null;
                if($this->cekDate($week, $day, $weeks, $startDay, $endDay)) {
                    $numberDate = $date++;
                }
                $dates[] = $numberDate;
            }
        }

        return $dates;
    }

    private function getnavigation(){
        $month = $this->currentMonth->format('m');
        $year = $this->currentMonth->format('Y');

        $next_month = $month==12?1:intval($month)+1;
        $next_year = $month==12?intval($year)+1:$year;
        $pre_month = $month==1?12:intval($month)-1;
        $pre_year = $month==1?intval($year)-1:$year;

        $prev_navigation = [
            'month' => $pre_month,
            'year' => $pre_year,
        ];

        $next_navigation = [
            'month' => $next_month,
            'year' => $next_year,
        ];

        $current_navigation = [
            'month' => $this->currentMonth->format('F'),
            'year' => $year,
        ];

        $navigation = [
            'prev_navigation' => $prev_navigation,
            'current_navigation' => $current_navigation,
            'next_navigation' => $next_navigation,
        ];

        return $navigation;
    }

    private function getPropertyMonth(){
        $month = $this->currentMonth->format('m');
        $year = $this->currentMonth->format('Y');
        $daysInMonth = $this->currentMonth->format('t');

        $weeks = ($daysInMonth%7==0?0:1) + intval($daysInMonth/7);

        $startDay = New \DateTime($year.'-'.$month.'-1');
        $startDay = $startDay->format('N');
        
        $endDay = New \DateTime($year.'-'.$month.'-'.$daysInMonth);
        $endDay = $endDay->format('N');

        if($endDay < $startDay){
            $weeks++;
        }

        $property = [
            'weeks' => $weeks,
            'start_day' => $startDay,
            'end_day' => $endDay,
        ];

        return $property;
    }

    private function cekDate($week, $day, $weeks, $startDay, $endDay)
    {
        $cek = ($week == 1 AND $day < $startDay);
        $cek = ($cek || ($week == $weeks AND $day > $endDay));
        return !$cek;
    }
}

$month = (!empty($_GET['month']))?$_GET['month']:null;
$year = (!empty($_GET['year']))?$_GET['year']:null;

$content = New Calendar($month, $year);

echo json_encode($content->show());