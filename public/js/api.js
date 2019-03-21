$(document).ready(function () {

$('#check').click(function () {
    var code = $('#team_code').val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        url: checkRoute,
        dataType: 'json',
        data: 'teamCode=' + code,
        success: function (data) {
            if (data.error == null) {
                $('#checkResult').text('Nice , your team\'s name is : ' + data.team_name).addClass('succ').removeClass('error');
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

})