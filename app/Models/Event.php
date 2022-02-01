<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function create_or_update(array $data, $id = null){
        $evnetData = [
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'repeat_group' => $data['RepeatGroup'],
        ];
        if($data['RepeatGroup'] == 1){
            $repeatData = [
                'lstRepeatType' => $data['lstRepeatType'],
                'lstEvery' => $data['lstEvery'],
            ];
        }elseif($data['RepeatGroup'] == 2){
            $repeatData = [
                'lstRepeatOn' => $data['lstRepeatOn'],
                'lstRepeatWeek' => $data['lstRepeatWeek'],
                'lstRepeatMonth' => $data['lstRepeatMonth'],
            ];
        }
        $evnetData['repeat_data'] = json_encode($repeatData);
       
        if($id){
            Event::find($id)->update($evnetData);
        }else{
            Event::create($evnetData);
        }
        
    }
}
