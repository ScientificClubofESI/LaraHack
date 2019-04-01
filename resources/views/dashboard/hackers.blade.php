@extends('layouts.dashboard.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.semanticui.min.css">
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
                                               @if($hacker->decision=='waiting') checked @endif> Waiting list
                                    </label>
                                    <label class="btn btn-red @if($hacker->decision=='rejected') active @endif"
                                           onclick="setdecision(this,'{{$hacker->id}}','rejected')">
                                        <input type="radio" name="options" id="rejected" autocomplete="off"
                                               @if($hacker->decision=='refused') checked @endif> Reject
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
    <!-- DataTable Scripts -->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{asset('js/dashboard/datatable.js')}}"></script>
    <!-- Set Decision Script -->
    <script type="text/javascript">
        const token = '{{csrf_token()}}';
        const route = "{{route('setDecision')}}";
    </script>
    <script src="{{asset('js/dashboard/set-decision.js')}}"></script>

@endpush