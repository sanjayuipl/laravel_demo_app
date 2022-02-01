@extends('app')
@section('content')
<div class="container">
   <h1>Event Listing</h1>
   @if(Session::has('success'))
   <div class="alert alert-success">
      {{ Session::get('success') }}
      @php
      Session::forget('success');
      @endphp
   </div>
   @endif
   <table class="table table-bordered table-hover">
    <thead>
        <th>Name</th>
        <th>Date</th>
        <th>Occurrence</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @if ($events->count() == 0)
        <tr>
            <td colspan="4">No events to display.</td>
        </tr>
        @endif

        @foreach ($events as $event)
         @php
           $repeat_details = get_repeat_group($event->repeat_group, $event->repeat_data);
         @endphp
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ $event->start_date }} - {{ $event->end_date }}</td>
            <td>{{ $repeat_details }}</td>
            <td>
                <a class="btn btn-sm btn-default" href="{{ route('event.show', [$event->id]) }}">View</a>
                <a class="btn btn-sm btn-success" href="{{ route('event.edit', [$event->id]) }}">Edit</a>

                <form style="display:inline-block" action="{{ route('event.destroy', [$event->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-sm btn-danger"> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $events->links() }}
   <p>
      Displaying {{$events->count()}} of {{ $events->total() }} product(s).
   </p>
</div>
@endsection
@section('javascript')
<script type="text/javascript">

</script> 
@endsection