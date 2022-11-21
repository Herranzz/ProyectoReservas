<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Fullcalender CRUD Events in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>

<body>

    <body style="background-color: #fff5f5" class="d-flex flex-column">
        <!-- navbar -->
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('/resources/images/ies-ribera-de-castilla_icon.jpg') }}" alt="Logo"
                    style="width:40px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    @if (auth()->check())
                        <li class="nav-item">
                            <p class="nav-link">Hola <b>{{ auth()->user()->email }}<b></p>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger" href=" {{ route('login.destroy') }}">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href=" {{ route('login.index') }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        {{-- Scripts --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready(function() {
                var SITEURL = "{{ url('/') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var calendar = $('#full_calendar_events').fullCalendar({
                    editable: true,
                    editable: true,
                    events: SITEURL + "/calendar-event",
                    displayEventTime: true,
                    eventRender: function(event, element, view) {
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function(event_start, event_end, allDay) {
                        var event_name = prompt('Event Name:');
                        if (event_name) {
                            var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                            var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url: SITEURL + "/calendar-crud-ajax",
                                data: {
                                    event_name: event_name,
                                    event_start: event_start,
                                    event_end: event_end,
                                    type: 'create'
                                },
                                type: "POST",
                                success: function(data) {
                                    displayMessage("Event created.");
                                    calendar.fullCalendar('renderEvent', {
                                        id: data.id,
                                        title: event_name,
                                        start: event_start,
                                        end: event_end,
                                        allDay: allDay
                                    }, true);
                                    calendar.fullCalendar('unselect');
                                }
                            });
                        }
                    },
                    eventDrop: function(event, delta) {
                        var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + '/calendar-crud-ajax',
                            data: {
                                title: event.event_name,
                                start: event_start,
                                end: event_end,
                                id: event.id,
                                type: 'edit'
                            },
                            type: "POST",
                            success: function(response) {
                                displayMessage("Event updated");
                            }
                        });
                    },
                    eventClick: function(event) {
                        var eventDelete = confirm("Are you sure?");
                        if (eventDelete) {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + '/calendar-crud-ajax',
                                data: {
                                    id: event.id,
                                    type: 'delete'
                                },
                                success: function(response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Event removed");
                                }
                            });
                        }
                    }
                });
            });

            function displayMessage(message) {
                toastr.success(message, 'Event');
            }
        </script>
        <!--footer simple anclado abajo-->
        <footer class="footer">
            <div class="footer-bottom text-center py-5">
                <p class="text-muted">© 2022 JHG <a href="http://iesriberadecastilla.centros.educa.jcyl.es/sitio/"
                        target="_blank">--IES Riebra de Castilla--</a></p>
            </div>
    </body>

</html>
