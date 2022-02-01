<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class EventController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(10);
        return view('event.index', compact('events'));
   
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('event.add');
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'RepeatGroup' => 'required',
        ]);
        
        $data = $request->all();
        
        Event::create_or_update($data);
        return redirect()->route('event.index')->withSuccess('Event Added');
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $event_datas = [];
        $repeat_value_obj = json_decode($event->repeat_data);
        // dd($repeat_value_obj);
        $i = 0;
        if($event->repeat_group == 1){ 
            if($repeat_value_obj->lstRepeatType != 2){
                $interval = $repeat_value_obj->lstRepeatType;
            }
            if($repeat_value_obj->lstEvery == 1){
                $period = CarbonPeriod::create($event->start_date, $interval.' day', $event->end_date);
            }elseif ($repeat_value_obj->lstEvery == 2) {
                $period = CarbonPeriod::create($event->start_date, $interval.' week' ,$event->end_date);
            }elseif ($repeat_value_obj->lstEvery == 3) {
                $period = CarbonPeriod::create($event->start_date, $interval.' month' ,$event->end_date);
            }elseif ($repeat_value_obj->lstEvery == 4) {
                $period = CarbonPeriod::create($event->start_date, $interval.' year' ,$event->end_date);
            }
            
            // Iterate over the period
            
            foreach ($period as $date) {
                $array = [
                    'date' =>$date->format('Y-m-d'),
                    'day' =>$date->format('l'),
                ];
                array_push($event_datas, $array);
                $i++;
            }
        }elseif($event->repeat_group == 2){
            $period = CarbonPeriod::create($event->start_date, '1 Sunday of the Month' ,$event->end_date);
            
            // Iterate over the period
            
            foreach ($period as $date) {
                $array = [
                    'date' =>$date->format('Y-m-d'),
                    'day' =>$date->format('l'),
                ];
                array_push($event_datas, $array);
                $i++;
            }

        }
        return view('event.show', compact('event', 'event_datas'));
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $event = Event::find($id);
        return view('event.edit', compact('event'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'RepeatGroup' => 'required',
        ]);
        
        $data = $request->all();
        
        Event::create_or_update($data, $id);
        return redirect()->route('event.index')->withSuccess('Event updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->route('event.index')->withSuccess('Event deleted');
    }
}
