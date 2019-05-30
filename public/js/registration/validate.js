$(document).ready(function () {
    jQuery.validator.addMethod(
        'regex',
        function (value, element, regexp) {
            var re = new RegExp(regexp);

            return this.optional(element) || re.test(value);
        },
        'type the correct value'
    );

    $('#register').validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element.next());
        },
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
                required: true
            },

            phone: {
                required: true,

                //regex: '^(((00213|\\+213|0)(5|6|7)[0-9]{8})|)$' Algerian phone number
                regex: '^\\+(?:[0-9] ?){6,14}[0-9]$'

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
            }
        },

        messages: {
            first_name: {
                required: "come on, you have a name, don't you?",

                minlength: 'your name must consist of at least 3 characters'
            },

            last_name: {
                required: "come on, you have a name, don't you?",

                minlength: 'your name must consist of at least 3 characters'
            },

            birthday: {
                required: "come on, you have a birthday date, don't you?"
            },

            phone: {
                required: "come on, you have a phone number, don't you?",

                regex: 'please enter a valid phone number (A plus sign, followed by the country code and national number).'
            },

            email: {
                required: 'no email, no registration !'
            },

            github: {
                url: 'no..no, you have to write a valid url (https://github.com/AbdelkhalekESI)'
            },

            linked_in: {
                url: 'no..no, you have to write a valid url (https://www.linkedin.com/in/adel-namani/)'
            },

            motivation: {
                required: 'um...yea, you have to write something to send this form.',

                minlength: 'thats all? really?'
            },

            skills: {
                required: 'um...yea, you have to write something to send this form.',

                minlength: 'thats all? really?'
            }
        },

        submitHandler: function (form) {
            $('#submitButton').off('click');
            //console.log($(this).serialize());
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                url: storeRoute,
                dataType: 'json',
                data: $('#register').serialize(),
                beforeSend: function () {
                    // $(document.body).css({ 'cursor': 'wait' });
                    $('#submitButton').html(
                        '<svg class="spinner" width="20px" height="20px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"> <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle> </svg>'
                    );
                },
                success: function (data) {
                    $(document.body).css({cursor: 'default'});
                    $('#register').hide();
                    $('#hideFinal').hide();
                    $('#registrationDone').show();
                    if (data.code != null) {
                        $('#statement').append(
                            'Registration done ! Your team\'s name is : <span style="color: #02A5DC ;"> ' +
                            data.name +
                            ' </span> <br> Your team\'s code is : <span style="color: #02A5DC ; ">' +
                            data.code +
                            '</span><br> Share it only with your teammates ! '
                        );
                    } else {
                        $('#statement').append('Registration done !');
                        //$('#registrationDone').append('<button class="custom-button fix-width" type="button"><a href="{{route("register")}}"><i class="fa fa-check-circle" aria-hidden="true"></i>Re-registration </a> </button>');
                    }
                    console.log(data);
                },
                error: function (response) {
                    $(document.body).css({cursor: 'default'});
                    $('#register').hide();
                    $('#hideFinal').hide();
                    $('#registrationDone').show();
                    $('#statement').text("That' an unxpected error , refresh and try again !");
                }
            });
        }
    });
});
