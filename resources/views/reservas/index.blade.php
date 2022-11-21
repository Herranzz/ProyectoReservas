@extends('layouts.app')

@section('template_title', 'Reservas')

@section('content')
<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' ]
      });

      calendar.render();
    });

</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
