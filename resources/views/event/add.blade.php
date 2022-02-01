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
   <form method="POST" action="{{ route('event.store') }}">
      {{ csrf_field() }}
      <div class="form-group">
         <label>Event Title:</label>
         <input type="text" name="name" class="form-control" placeholder="Name" required>
         @if ($errors->has('name'))
         <span class="text-danger">{{ $errors->first('name') }}</span>
         @endif
      </div>
      <div class="form-group">
         <label>Start Date:</label>
         <input type="text" name="start_date" class="form-control datetimepicker" placeholder="start date" required>
         @if ($errors->has('start_date'))
         <span class="text-danger">{{ $errors->first('start_date') }}</span>
         @endif
      </div>
      <div class="form-group">
         <label>End Date:</label>
         <input type="text" name="end_date" class="form-control datetimepicker" placeholder="End date" required>
         @if ($errors->has('end_date'))
         <span class="text-danger">{{ $errors->first('end_date') }}</span>
         @endif
      </div>
      <div class="form-group">
         <input id="Radiobutton1" name="RepeatGroup" tabindex="9" type="radio" value="1" required /><label
            for="Radiobutton1"><span style="font-size: 10pt; font-family: Verdana">Repeat</span></label>
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
         <select id="lstRepeatType" class="textbox-medium"
            name="lstRepeatType" style="font-size: x-small; width: 100px; font-family: Verdana"
            tabindex="10">
            <option selected="selected" value="1">Every</option>
            <option value="2">Every Other</option>
            <option value="3">Every Third</option>
            <option value="4">Every Fourth</option>
         </select>
         <select id="lstEvery" class="textbox-medium" name="lstEvery" style="font-size: x-small;
            width: 66px; font-family: Verdana" tabindex="10">
            <option selected="selected" value="1">Day</option>
            <option value="2">Week</option>
            <option value="3">Month</option>
            <option value="4">Year</option>
         </select>
      </div>
      <div class="form-group">
         <input id="RadioButton2" tabIndex=11 type=radio value="2" 
            name="RepeatGroup" required />
         <span style="font-size: 10pt; font-family: Verdana">
            Repeat on the
            <select id="lstRepeatOn" class="textbox-middle" name="lstRepeatOn" style="font-size: x-small;
               width: 68px; font-family: Verdana" tabindex="12">
               <option selected="selected" value="1">First</option>
               <option value="2">Second</option>
               <option value="3">Third</option>
               <option value="4">Fourth</option>
            </select>
         </span>
         &nbsp;
         <select id="lstRepeatWeek" class="textbox-middle" name="lstRepeatWeek"
            style="font-size: x-small; width: 56px; font-family: Verdana" tabindex="13">
            <option selected="selected" value="0">Sun</option>
            <option value="1">Mon</option>
            <option value="2">Tue</option>
            <option value="3">Wed</option>
            <option value="4">Thu</option>
            <option value="5">Fri</option>
            <option value="6">Sat</option>
         </select>
         of the
         <select id="lstRepeatMonth" class="textbox-middle" language="javascript" name="lstRepeatMonth"
            style="font-size: x-small; width: 80px;
            font-family: Verdana" tabindex="14">
            <option selected="selected" value="1">Month</option>
            <option value="3">3 Months</option>
            <option value="4">4 Months</option>
            <option value="6">6 Months</option>
            <option value="12">Year</option>
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