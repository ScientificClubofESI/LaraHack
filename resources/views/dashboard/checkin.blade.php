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
                <h1 class="text-center font-weight-900 text-xl"> Confirmed Hackers </h1>
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
                        <th scope="col">Size</th>

                        <th scope="col">E-mail</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Check-in</th>
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
                            <td>{{$hacker->size }}</td>

                            <td>{{$hacker->email }}</td>
                            <td>{{$hacker->phone_number }}</td>
                            <td>
                                <div class="ui checkbox">
                                    <input
                                            @if($hacker->checked)
                                            checked
                                            @endif
                                            type="checkbox" name="public" onclick="checkHacker({{$hacker->id}})">
                                    <label> </label>
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
    <!-- DataTable Semantic UI -->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.semanticui.min.js"></script>
    <script src="{{asset('js/dashboard/confirm-datatable.js')}}"></script>
    <!-- Check-In Hacker -->
    <script type="text/javascript">
        const token = '{{csrf_token()}}';
    </script>
    <script src="{{asset('js/dashboard/check-hacker.js')}}"></script>


@endpush