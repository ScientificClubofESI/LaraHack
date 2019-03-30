@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.semanticui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.semanticui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/checkbox.min.css">
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
                                <div class="ui toggle checkbox">
                                    <input
                                            @if($hacker->checked)
                                            checked
                                            @endif
                                            type="checkbox" name="public" onclick="checkHacker({{$hacker->id}})">
                                    <label></label>
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
    {{-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/checkbox.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            }
        );

        const token = '{{csrf_token()}}';

        function checkHacker(id) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: "POST",
                url: "{{route('checkHacker')}}",
                dataType: 'json',
                data: JSON.stringify({id: id}),
                beforeSend: function () {
                    $(document.body).css({'cursor': 'wait'});
                },
                success: function () {
                    $(document.body).css({'cursor': 'default'});
                },
                error: function () {
                    swal("Oops", "Something went wrong!", "error");
                    $(document.body).css({'cursor': 'default'});
                }
            })
        }

    </script>


@endpush