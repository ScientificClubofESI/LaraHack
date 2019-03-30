@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.semanticui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.semanticui.min.css">
    {{--
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/datatables.min.css"/>
    --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/hackers.css')}}">
@endsection

@section('content')
    <div class="container  pt-3 pb-7">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="text-center font-weight-900 text-xl"> Hackers </h1>
            </div>
            <div class="col-md-10">

            </div>
            <div class="col-md-10">
                <table id="Hackers" class=" display wrap collapsed dataTable ui celled table" width="100%">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Team</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Size</th>

                        <th scope="col">E-mail</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Github</th>
                        <th scope="col">LinkedIn</th>

                        <th scope="col">Skills</th>
                        <th scope="col">Motivation</th>
                        <th hidden>Decision</th>

                        <th scope="col">Take a decision</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hackers as $hacker)
                        <tr id="{{$hacker->id}}">


                            @if(isset($hacker->team_name))
                                <td>{{$hacker->team_name }}</td>
                            @else
                                <td></td>
                            @endif

                            <td>{{$hacker->first_name }}</td>
                            <td>{{$hacker->last_name }}</td>
                            <td>{{$hacker->birthday }}</td>
                            <td>{{$hacker->sex }}</td>
                            <td>{{$hacker->size }}</td>

                            <td>{{$hacker->email }}</td>
                            <td>{{$hacker->phone_number }}</td>

                            <td>
                                <a href="{{$hacker->github }}" target="_blank">
                                    {{$hacker->github }}
                                </a>
                            </td>
                            <td>
                                <a href="{{$hacker->linked_in }}" target="_blank">
                                    {{$hacker->linked_in }}
                                </a>

                            </td>

                            <td>{{$hacker->skills }}</td>
                            <td>{{$hacker->motivation }}</td>
                            <td hidden>{{$hacker->decision}}</td>


                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-green @if($hacker->decision=='accepted') active @endif "
                                           onclick="setdecision(this,'{{$hacker->id}}','accepted')">
                                        <input type="radio" name="options" id="accepted" autocomplete="off"
                                               @if($hacker->decision=='accepted') checked @endif> Accept
                                    </label>
                                    <label class="btn btn-light @if($hacker->decision=='waiting_list') active @endif"
                                           onclick="setdecision(this,'{{$hacker->id}}','waiting_list')">
                                        <input type="radio" name="options" id="waiting" autocomplete="off"
                                               @if($hacker->decision=='waiting') checked @endif> To waiting list
                                    </label>
                                    <label class="btn btn-red @if($hacker->decision=='rejected') active @endif"
                                           onclick="setdecision(this,'{{$hacker->id}}','rejected')">
                                        <input type="radio" name="options" id="rejected" autocomplete="off"
                                               @if($hacker->decision=='refused') checked @endif> reject
                                    </label>
                                </div>
                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- jQuery Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- DataTable Semantic UI -->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- PDF Make -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <!-- Previous DataTables -->
    {{--
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/datatables.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    --}}
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script type="text/javascript">
        'use strict';
        const token = '{{csrf_token()}}';

        function setdecision(element, member_id, decision) {

            let formData = new FormData();
            formData.append('_token', token);
            formData.append('id', member_id);
            formData.append('decision', decision);
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: "POST",
                url: "{{route('setDecision')}}",
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(document.body).css({'cursor': 'wait'});
                },
                success: function (json) {
                    //set the changes
                    if (json.response) {

                    }
                    $(document.body).css({'cursor': 'default'});
                },
                error: function (response) {

                    if (response.status === 401) //redirect if not authenticated user.
                        window.location = '/errors/401';
                    else if (response.status === 422) {
                    } else {
                    }
                    swal("Oops", "Something went wrong!", "error");
                    $(document.body).css({'cursor': 'default'});
                }
            })
        }

    </script>

    <script type="text/javascript">
        $('#Hackers').DataTable(
            {
                responsive: true,
                dom: "<'ui stackable grid'" +
                    "<'row'" +
                    "<'eight wide column' B>" +
                    "<'right aligned eight wide column'f>" +
                    ">" +
                    "<'row dt-table'" +
                    "<'sixteen wide column'tr>" +
                    ">" +
                    "<'row'" +
                    "<'seven wide column'i>" +
                    "<'right aligned nine wide column'p>" +
                    ">" +
                    ">",
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
            }
        )

    </script>


@endpush