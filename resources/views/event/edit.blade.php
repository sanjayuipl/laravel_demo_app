@extends('app')
@section('content')
<div class="container">
   <h1>Add Event</h1>
   @if(Session::has('success'))
   <div class="alert alert-success">
      {{ Session::get('success') }}
      @php
      Session::forget('success');
      @endphp
   </div>
   @endif
   <form method="POST" action="{{route('event.update',$event->id)}}">
      
      {{csrf_field()}}

      {{ method_field('PATCH') }}
      @php
      $repeat_group_all_data = get_repeat_group_all_data();
      $repeat_value_obj = json_decode($event->repeat_data);
      @endphp
      <div class="form-group">
         <label>Event Title:</label>
         <input type="text" name="name" class="form-control" placeholder="Name" required value="{{old('name',$event->name)}}">
         @if ($errors->has('name'))
         <span class="text-danger">{{ $errors->first('name') }}</span>
         @endif
      </div>
      <div class="form-group">
         <label>Start Date:</label>
         <input type="text" name="start_date" class="form-control datetimepicker" placeholder="start date" required value="{{old('start_date',$event->start_date)}}">
         @if ($errors->has('start_date'))
         <span class="text-danger">{{ $errors->first('start_date') }}</span>
         @endif
      </div>
      <div class="form-group">
         <label>End Date:</label>
         <input type="text" name="end_date" class="form-control datetimepicker" placeholder="End date" required value="{{old('end_date',$event->end_date)}}">
         @if ($errors->has('end_date'))
         <span class="text-danger">{{ $errors->first('end_date') }}</span>
         @endif
      </div>
      <div class="form-group">
         <input id="Radiobutton1" name="RepeatGroup" tabindex="9" type="radio" value="1" required {{ $event->repeat_group == '1' ? 'checked' : ''}} /><label
            for="Radiobutton1"><span style="font-size: 10pt; font-family: Verdana">Repeat</span></label>
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         <select id="lstRepeatType" class="textbox-medium"
            name="lstRepeatType" style="font-size: x-small; width: 100px; font-family: Verdana"
            tabindex="10">
            @foreach($repeat_group_all_data['lstRepeatType'] as $key => $value)
               @php
                  $selected_chk = $repeat_value_obj->lstRepeatType ?? null;
                  $selected     = ($selected_chk && $selected_chk == $key) ? 'selected' : '';
               @endphp
               <option  {{$selected}} value="{{$key}}">{{ $value}}</option>
            @endforeach
         </select>
         <select id="lstEvery" class="textbox-medium" name="lstEvery" style="font-size: x-small;
            width: 66px; font-family: Verdana" tabindex="10">
            @foreach($repeat_group_all_data['lstEvery'] as $key => $value)
               @php
                  $selected_chk = $repeat_value_obj->lstEvery ?? null;
                  $selected     = ($selected_chk && $selected_chk == $key) ? 'selected' : '';
               @endphp
               <option  {{$selected}} value="{{$key}}">{{ $value}}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <input id="RadioButton2" tabIndex=11 type=radio value="2" 
            name="RepeatGroup" required {{ $event->repeat_group == '2' ? 'checked' : ''}}/>
         <span style="font-size: 10pt; font-family: Verdana">
            Repeat on the
            <select id="lstRepeatOn" class="textbox-middle" name="lstRepeatOn" style="font-size: x-small;
               width: 68px; font-family: Verdana" tabindex="12">
               @foreach($repeat_group_all_data['lstRepeatOn'] as $key => $value)
                  @php
                     $selected_chk = $repeat_value_obj->lstRepeatOn ?? null;
                     $selected     = ($selected_chk && $selected_chk == $key) ? 'selected' : '';
                  @endphp
                  <option  {{$selected}} value="{{$key}}">{{ $value}}</option>
               @endforeach
            </select>
         </span>
         &nbsp;
         <select id="lstRepeatWeek" class="textbox-middle" name="lstRepeatWeek"
            style="font-size: x-small; width: 56px; font-family: Verdana" tabindex="13">
            @foreach($repeat_group_all_data['lstRepeatWeek'] as $key => $value)
               @php
                  $selected_chk = $repeat_value_obj->lstRepeatWeek ?? null;
                  $selected     = ($selected_chk && $selected_chk == $key) ? 'selected' : '';
               @endphp
               <option  {{$selected}} value="{{$key}}">{{ $value}}</option>
            @endforeach
         </select>
         of the
         <select id="lstRepeatMonth" class="textbox-middle" language="javascript" name="lstRepeatMonth"
            style="font-size: x-small; width: 80px;
            font-family: Verdana" tabindex="14">
             @foreach($repeat_group_all_data['lstRepeatMonth'] as $key => $value)
               @php
                  $selected_chk = $repeat_value_obj->lstRepeatMonth ?? null;
                  $selected     = ($selected_chk && $selected_chk == $key) ? 'selected' : '';
               @endphp
               <option  {{$selected}} value="{{$key}}">{{ $value}}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <button class="btn btn-success btn-submit">Submit</button>
      </div>
   </form>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
   $(function() {
       $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'en'
        });
   });
</script> 
@endsection