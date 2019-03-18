@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table id="Hackers" class="display dataTable dtr-inline collapsed" width="100%">
                    <thead>
                    <tr>
                        <th>Team</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Birthday</th>
                        <th>Sex</th>
                        <th>Size</th>

                        <th>E-mail</th>
                        <th>Phone</th>
                        <th>Github</th>
                        <th>LinkedIn</th>

                        <th>Skills</th>
                        <th>Motivation</th>
                        <th hidden>Decision</th>

                        <th>Take a decision</th>


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
                                    <img class="icon-cnt"
                                         src="{{asset("img/icon/github.png")}}" alt="Github">
                                </a>
                                {{$hacker->github }}
                            </td>
                            <td>
                                <a href="{{$hacker->linked_in }}" target="_blank">
                                    <img class="icon-cnt"
                                         src="{{asset("img/icon/linkedin.png")}}"
                                         alt="LinkedIn">
                                </a>
                                {{$hacker->linked_in }}
                            </td>

                            <td>{{$hacker->skills }}</td>
                            <td>{{$hacker->motivation }}</td>
                            <td hidden>{{$hacker->decision}}</td>


                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light @if($hacker->decision=='accepted') active @endif " onclick="setdecision(this,'{{$hacker->id}}','accepted')" >
                                        <input type="radio" name="options" id="accepted" autocomplete="off" @if($hacker->decision=='accepted') checked @endif> Accept
                                    </label>
                                    <label class="btn btn-light @if($hacker->decision=='waiting_list') active @endif" onclick="setdecision(this,'{{$hacker->id}}','waiting_list')">
                                        <input type="radio" name="options" id="waiting" autocomplete="off" @if($hacker->decision=='waiting') checked @endif> To waiting list
                                    </label>
                                    <label class="btn btn-light @if($hacker->decision=='rejected') active @endif" onclick="setdecision(this,'{{$hacker->id}}','rejected')">
                                        <input type="radio" name="options" id="rejected" autocomplete="off" @if($hacker->decision=='refused') checked @endif> reject
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

    <script type="text/javascript">
        'use strict';
        const token='{{csrf_token()}}';
        function setdecision(element,member_id,decision) {

            let formData=new FormData();
            formData.append('_token',token);
            formData.append('id',member_id);
            formData.append('decision',decision);
            $.ajax({
                headers:{'X-CSRF-TOKEN': token},
                type:"POST",
                url:"{{route('setDecision')}}",
                dataType:'json',
                data:formData,
                contentType:false,
                processData:false,
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
                    $(document.body).css({'cursor': 'default'});
                }
            })
        }
    </script>

    <script type="text/javascript">
        $('#Hackers').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'csv'
            ]
        });
    </script>
@endsection
