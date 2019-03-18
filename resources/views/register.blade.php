@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="registrationDone" class="card">
                    <div class="card-header">Hi :)</div>

                    <div class="card-body">
                        <p id="statement"></p>
                    </div>
                </div>
                <form id="register" method="POST">
                    <h2>Register</h2>
                    <p>Challenge your self and register for Hack !T 2K18</p>
                    @csrf
                    <div class="form-group col-lg-12">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="First Name*">
                    </div>

                    <div class="form-group col-lg-12">
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               placeholder="Last Name*">
                    </div>

                    <div class="form-group col-lg-12">
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Email address*">
                    </div>

                    <div class="form-group col-lg-12">
                        <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Birthday*">
                    </div>

                    <div class="form-group col-lg-12">
                        <select class="form-control col-lg-6" id="sex" name="sex">
                            <option value="" disabled selected>Gender:</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number*">
                    </div>

                    <div class="form-group col-lg-12">
                        <textarea type="text" class="form-control" id="motivation" name="motivation"
                                  placeholder="Motivation*"></textarea>
                    </div>

                    <div class="form-group col-lg-12">
                        <input type="text" class="form-control" id="github" name="github" placeholder="Github*">
                    </div>

                    <div class="form-group col-lg-12">
                        <input type="text" class="form-control" id="linked_in" name="linked_in" placeholder="LinkedIn*">
                    </div>

                    <div class="form-group col-lg-12">
                        <textarea type="text" class="form-control" id="skills" name="skills"
                                  placeholder="Skills*"></textarea>
                    </div>

                    <div class="form-group col-lg-12">
                        <select class="form-control col-lg-6" id="size" name="size">
                            <option value="" disabled selected>Size :</option>
                            <option value="XL">XL</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="S">S</option>
                        </select>
                    </div>

                    <input type="text" hidden id="team_id" name="team_id">

                    <div class="row">
                        <div class="col-lg-12">
                            <p class="float-left">Do you have a team ? </p>
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                <label class="btn btn-secondary" id="yesTeam">
                                    <input type="radio" autocomplete="off"> Yes
                                </label>
                                <label class="btn btn-secondary" id="noTeam">
                                    <input type="radio" autocomplete="off"> No
                                </label>
                            </div>


                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-lg-12" id="createJoin">
                            <p class="float-left">Do you want to create a team or join one ?</p>
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                <label class="btn btn-secondary" id="createTeam">
                                    <input type="radio"  autocomplete="off"> Create
                                </label>
                                <label class="btn btn-secondary " id="joinTeam">
                                    <input type="radio"  autocomplete="off" > Join
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group col-lg-12" id="teamName">
                        <input type="text" class="form-control" id="team_name" name="team_name"
                               placeholder="Team's name">
                    </div>
                    <br>
                    <br>
                    <div class="input-group mb-3" id="teamCode">
                        <input type="text" class="form-control" id="team_code" placeholder="Team's code" >
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="check" type="button">Check</button>
                        </div>
                        <br>
                        <div><p id="checkResult"></p></div>
                    </div>

                    <br>
                    <br>
                    <div class="row">
                        <div class="col-lg-12" id="sub">
                            <button class="btn btn-outline-success float-right" id="submitButton">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        const token = '{{csrf_token()}}';
        $(document).ready(function () {
            $('#registrationDone').hide();
            $('#createJoin').hide();
            $('#sub').hide();
            $('#teamName').hide();
            $('#teamCode').hide();
            $('#yesTeam').click(function () {
                $('#noTeam').removeClass('active');
                $(this).addClass('active');
                $('#sub').hide();
                $('#createJoin').show();
            });
            $('#noTeam').click(function () {
                $('#yesTeam').removeClass('active');
                $(this).addClass('active');
                $('#createJoin').hide();
                $('#sub').show();
                $('#teamName').hide();
                $('#teamCode').hide();
            });
            $('#createTeam').click(function () {
                $(this).addClass('active');
                $('#joinTeam').removeClass('active');
                $('#teamName').show();
                $('#teamCode').hide();
                $('#sub').show();
                $('#team_code').val('');
                $('#team_id').val('');
            });
            $('#joinTeam').click(function(){
                $(this).addClass('active');
                $('#createTeam').removeClass('active');
                $('#teamName').hide();
                $('#teamCode').show();
                $('#team_name').val('');
            });
            $('#check').click(function () {
                var code=$('#team_code').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': token},
                    type: "POST",
                    url: "{{route('check')}}",
                    dataType: 'json',
                    data: 'teamCode='+code,
                    success:function (data) {
                        if (data.error==null){
                            $('#checkResult').text('Hi :p your team\'s name is:'+data.team_name);
                            $('#team_id').val(data.id);
                            $('#sub').show();
                        }
                        else {
                            $('#checkResult').text(data.error);
                            $('#sub').hide();
                        }
                    },
                    error:function (response) {
                        $('#checkResult').text('Hi :p error ');
                        $('#sub').hide();
                    }
                })
            });
            $('#register').on('submit', function (event) {
                event.preventDefault();
                $('#submitButton').off('click');
                console.log($(this).serialize());
                $.ajax({
                    headers: {'X-CSRF-TOKEN': token},
                    type: "POST",
                    url: "{{route('store')}}",
                    dataType: 'json',
                    data: $('#register').serialize(),
                    beforeSend: function () {
                        $(document.body).css({'cursor': 'wait'});
                    },
                    success: function (data) {
                        $(document.body).css({'cursor': 'default'});
                        $('#register').hide();
                        $('#registrationDone').show();
                        if (data.code != null) {
                            $('#statement').text(data.success + ' Your team\'s name is :' + data.name + ' Your team\'s code is : ' + data.code);
                        }
                        else {
                            $('#statement').text(data.success);
                        }
                        console.log(data);
                    },
                    error: function (response) {
                        $(document.body).css({'cursor': 'default'});
                        $('#register').hide();
                        $('#registrationDone').show();
                        $('#statement').text('Error');
                    }
                })
            });
        });
    </script>


@endsection