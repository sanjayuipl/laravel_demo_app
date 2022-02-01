<?php

function get_repeat_group_all_data()
{ 
    $repeat_group_all_data = [
        'lstRepeatType' => [
            '1' => 'Every',
            '2' => 'Every Other',
            '3' => 'Every Third',
            '4' => 'Every Fourth',
        ],
        'lstEvery' => [
            '1' => 'Day',
            '2' => 'Week',
            '3' => 'Month',
            '4' => 'Year',
        ],
        'lstRepeatOn' => [
            '1' => 'First',
            '2' => 'Second',
            '3' => 'Third',
            '4' => 'Fourth',
        ],
        'lstRepeatWeek' => [
            '0' => 'Sun',
            '1' => 'Mon',
            '2' => 'Tue',
            '3' => 'Wed',
            '4' => 'Thu',
            '6' => 'Fri',
            '7' => 'Sat',
        ],
        'lstRepeatMonth' => [
            '1' => 'Month',
            '3' => '3 Month',
            '4' => '4 Month',
            '6' => '6 Month',
            '12' => 'Year'
        ]
    ];
    return $repeat_group_all_data;
}

if (! function_exists('get_repeat_group')) {
    function get_repeat_group($repeat_group, $repeat_value)
    { 
       
       
        $repeat_group_all_data = get_repeat_group_all_data();
        $repeat_value_obj = json_decode($repeat_value);
        if ($repeat_group == 1){
            $repeat_group_str = $repeat_group_all_data['lstRepeatType'][$repeat_value_obj->lstRepeatType] . ' ' . $repeat_group_all_data['lstEvery'][$repeat_value_obj->lstEvery];
         }elseif($repeat_group == 2){
            $repeat_group_str = 'Every ' . $repeat_group_all_data['lstRepeatOn'][$repeat_value_obj->lstRepeatOn] . ' ' . $repeat_group_all_data['lstRepeatWeek'][$repeat_value_obj->lstRepeatWeek] . ' of the ' . $repeat_group_all_data['lstRepeatMonth'][$repeat_value_obj->lstRepeatMonth];
         }
        
        return $repeat_group_str;
    }
}