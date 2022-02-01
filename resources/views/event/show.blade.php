@extends('app')
@section('content')
<div class="container">
   <h1>Event View</h1>
   @if(Session::has('success'))
   <div class="alert alert-success">
      {{ Session::get('success') }}
      @php
      Session::forget('success');
      @endphp
   </div>
   @endif
 
      <div class="form-group">
         <label>Event Title: {{$event->name}}</label>
      </div>
      <table class="table table-bordered table-hover">
         <thead>
            <th>Date</th>
            <th>Day</th>
         </thead>
         <tbody>
            @if (count($event_datas) == 0)
            <tr>
                  <td colspan="2">No events to display.</td>
            </tr>
            @endif
            @if (count($event_datas) > 0)
               @foreach ($event_datas as $event_data)
                  <tr>
                        <td>{{ $event_data['date'] }}</td>
                        <td>{{ $event_data['day'] }}</td>
                  </tr>
               @endforeach
            @endif
         </tbody>
      </table>
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