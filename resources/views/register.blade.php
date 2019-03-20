@extends('layouts.default')
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <link rel="stylesheet" href="{{asset('datepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">
        <div class="home-title">

            <div class="row not-typed">
                <div class="col-12">
                    <img class="logo-img" src="{{asset('images/LOGO.png')}}" alt="CSE">
                </div>
            </div>

            <div class="row justify-content-center come">
                <span>Challenge yourself and register in Hack!T ! <br>A few Steps from the biggest student hackathon .</span>
            </div>
            <div class="row justify-content-center">
                <button id="go-ahead" class="custom-button"> Go Ahead !</button>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="registrationDone" class="come">
                        <p id="statement"></p>
                </div>
                <form id="register" method="POST">
                    @csrf
                    <div class="formi col-lg-12">
                        <label class="labeli" for="first_name">What's your first name ?</label>
                        <input type="text" class="inputi" id="first_name" name="first_name"
                               placeholder="Your name here">
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="last_name">What's your last name ?</label>
                        <input type="text" class="inputi" id="last_name" name="last_name"
                               placeholder="Your last name here">
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="email">What's your email adress ?</label>
                        <input type="text" class="inputi" id="email" name="email" placeholder="Your email address here">
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="birthday">What's your birthday ?</label>
                        <!--<input type="date" class="inputi" id="birthday" name="birthday" placeholder="Birthday*">-->
                        <input id="birthday" name="birthday" type="text" class="inputi datepicker-here" data-language='en'>
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="sex">What's your gender ?</label>
                        <select class="inputi" id="sex" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="phone">What's your phone number ?</label>
                        <input type="text" class="inputi" id="phone" name="phone" placeholder="Your phone number here">
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="motivation">Why do you want to participate in hackIT?</label>
                        <textarea type="text" rows=6 class="inputi" id="motivation" name="motivation"
                                  placeholder="Motivation"></textarea>
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="github">We need you github !</label>
                        <input type="text" class="inputi" id="github" name="github"
                               placeholder="your github profile's link here">
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="linked_in">And your linkedIn too !</label>
                        <input type="text" class="inputi" id="linked_in" name="linked_in"
                               placeholder="your linkedIn profile's link here">
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-12">
                        <label class="labeli" for="skills">What about your skills ?</label>
                        <textarea rows=6 type="text" class="inputi" id="skills" name="skills"
                                  placeholder="Skills"></textarea>
                        <div class="separator"></div>
                    </div>

                    <div class="formi col-lg-8">
                        <label class="labeli" for="size">You want a t-shirt right ! which size ?</label>
                        <select class="inputi" id="size" name="size">
                            <option value="XL">XL</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="S">S</option>
                        </select>
                        <div class="separator"></div>
                    </div>

                    <input type="text" hidden id="team_id" name="team_id">
                    <div class="bani col-lg-12">

                        <span class="labeli">Do you have a team ?</span>
                        <div class="row justify-content-between custom-switch">

                            <div class="ui buttons ">
                                <div class="ui positive button" id="yesTeam">Yes</div>
                                <div class="or"></div>
                                <div class="ui negative button" id="noTeam">No</div>
                            </div>
                        </div>
                    </div>

                    <div class="bani col-lg-12" id="createJoin">
                        <span class="labeli">Do you want to create a team or join one ?</span>

                        <div class="row justify-content-between custom-switch">

                            <div class="ui buttons">
                                <div class="ui black button" id="createTeam">Create</div>
                                <div class="or"></div>
                                <div class="ui grey button" id="joinTeam">Join</div>
                            </div>
                        </div>
                    </div>

                    <div class="dicidi col-lg-12" id="teamName" style="padding-bottom: 30px;">
                        <label class="labeli">Team name</label>
                        <input type="text" class="inputi" id="team_name" name="team_name"
                               placeholder="Your team's name here">
                        <div class="separator"></div>
                    </div>
                    <div class="dicidi col-lg-12" id="teamCode">
                        <label class="labeli">Team's code</label>
                        <div class="checkDiv">
                            <input type="text" class="inputi checkInput" id="team_code"
                                   placeholder="Your team's code here to check it ...">
                            <button class="custom-button checkButton" id="check" type="button"><i
                                        class="fa fa-check-circle" aria-hidden="true"></i>Check
                            </button>
                        </div>
                        <div class="separator"></div>
                        <div>
                            <p id="checkResult"></p>
                        </div>
                    </div>

                    <div class="dicidi col-lg-12" id="sub">
                        <button class="custom-button" id="submitButton">Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
    {{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.9/typed.min.js"></script> --}}
    <script src="{{asset('datepicker/dist/js/datepicker.min.js')}}"></script>
    <script src="{{asset('datepicker/dist/js/i18n/datepicker.en.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{asset('js/register.js')}}"></script>
    <script type="text/javascript">
        const token = '{{csrf_token()}}';
        $(document).ready(function () {
            $('#registrationDone').hide();
            $('#createJoin').addClass('hidi');
            $('#sub').addClass('hidi');
            $('#teamName').addClass('hidi');
            $('#teamCode').addClass('hidi');

            $('#yesTeam').click(function (e) {
                //e.preventDefault();
                $('#noTeam').removeClass('active');
                $(this).addClass('active');
                $('#sub').addClass('hidi').removeClass('bani');
                $('#createJoin').addClass('bani').removeClass('hidi');
            });

            $('#noTeam').click(function (e) {
                //e.preventDefault();
                $('#yesTeam').removeClass('active');
                $(this).addClass('active');
                $('#createJoin').addClass('hidi').removeClass('bani');
                $('#sub').addClass('bani').removeClass('hidi');
                $('#teamName').addClass('hidi').removeClass('bani');
                $('#teamCode').addClass('hidi').removeClass('bani');

                $('#team_code').val('');
                $('#team_id').val('');
                $('#team_name').val('');
            });

            $('#createTeam').click(function (e) {
                //e.preventDefault();
                $(this).addClass('active');
                $('#joinTeam').removeClass('active');
                $('#teamName').addClass('bani').removeClass('hidi');
                $('#teamCode').addClass('hidi').removeClass('bani');
                $('#sub').addClass('bani').removeClass('hidi');
                $('#team_code').val('');
                $('#team_id').val('');
            });

            $('#joinTeam').click(function (e) {
                //e.preventDefault();
                $(this).addClass('active');
                $('#createTeam').removeClass('active');
                $('#teamName').addClass('hidi').removeClass('bani');
                $('#teamCode').addClass('bani').removeClass('hidi');
                $('#sub').addClass('hidi').removeClass('bani');
                $('#team_name').val('');
            });

            $('#check').click(function () {
                var code = $('#team_code').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': token},
                    type: "POST",
                    url: "{{route('check')}}",
                    dataType: 'json',
                    data: 'teamCode=' + code,
                    success: function (data) {
                        if (data.error == null) {
                            $('#checkResult').text('Nice , your team\'s name is:' + data.team_name).addClass('succ').removeClass('error');
                            $('#team_id').val(data.id);
                            $('#sub').addClass('bani').removeClass('hidi');

                        }
                        else {
                            $('#checkResult').text('Oh no ! your code is not valid , check with your teammates again !').addClass('error').removeClass('succ');
                            $('#sub').addClass('hidi').removeClass('bani');
                        }

                    },
                    error: function (response) {
                        $('#checkResult').text('There must be an error , refresh and try again');
                        $('#sub').addClass('hidi').removeClass('bani');
                    }

                })
            });

            jQuery.validator.addMethod(
                'regex',

                function (value, element, regexp) {

                    var re = new RegExp(regexp);

                    return this.optional(element) || re.test(value);

                },

                "type the correct value"
            );


            $('#register').validate({

                rules: {

                    first_name: {

                        required: true,

                        minlength: 3

                    },

                    last_name: {

                        required: true,

                        minlength: 3

                    },

                    birthday: {

                        required: true,

                    },


                    phone: {

                        required: true,

                        minlength: 10,

                        regex: "^(((00213|\\+213|0)(5|6|7)[0-9]{8})|)$"

                    },

                    email: {

                        required: true,

                        email: true

                    },

                    github: {

                        required: false,

                        url: true

                    },

                    linked_in: {

                        required: false,

                        url: true

                    },


                    motivation: {

                        required: true,

                        minlength: 20,

                        maxlength: 3000

                    },

                    skills: {

                        required: true,

                        minlength: 20,

                        maxlength: 3000

                    },

                },

                messages: {

                    first_name: {

                        required: "come on, you have a name, don't you?",

                        minlength: "your name must consist of at least 3 characters"

                    },

                    last_name: {

                        required: "come on, you have a name, don't you?",

                        minlength: "your name must consist of at least 3 characters"

                    },

                    birthday: {

                        required: "come on, you have a birthday, don't you?",

                    },

                    phone: {

                        required: "come on, you have a number, don't you?",

                        minlength: "your Number must consist of at least 10 characters",

                        regex: "plz enter a valid phone number"

                    },

                    email: {

                        required: "no email, no registration"

                    },

                    github: {

                        url: "no..no, you have to write a valid url (http://github.com/metourni)"

                    },

                    linked_in: {

                        url: "no..no, you have to write a valid url (http://linked-in.com/metourni)"

                    },

                    motivation: {

                        required: "um...yea, you have to write something to send this form.",

                        minlength: "thats all? really?"

                    },

                    skills: {

                        required: "um...yea, you have to write something to send this form.",

                        minlength: "thats all? really?"

                    },

                },

                submitHandler: function (form) {
                    $('#submitButton').off('click');
                    //console.log($(this).serialize());
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
                                $('#statement').text('Registration done ! Your team\'s name is : ' + data.name + ' Your team\'s code is : ' + data.code + ' Keep that code secret and share it only with your teammates!');
                            }
                            else {
                                $('#statement').text('Registration done !');
                            }
                            console.log(data);
                        },
                        error: function (response) {
                            $(document.body).css({'cursor': 'default'});
                            $('#register').hide();
                            $('#registrationDone').show();
                            $('#statement').text('That\' an unxpected error , refresh and try again !');
                        }

                    });
                }
            });

            /*$('#register').on('submit', function (event) {
                event.preventDefault();
                $('#submitButton').off('click');
                console.log($(this).serialize());
                $.ajax({
                    headers: {'X-CSRF-TOKEN': token},
                    type: "POST",
                    url: "{-{route('store')}}",
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

                });
            });*/
        });
    </script>
@endsection