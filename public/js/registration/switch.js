$(document).ready(function () {
    //$('#registrationDone').hide();
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
});