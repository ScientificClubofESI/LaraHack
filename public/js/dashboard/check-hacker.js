function checkHacker(id) {
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        url: `/admin/hackers/checkin/${id}`,
        dataType: 'json',
        beforeSend: function () {
            $(document.body).css({'cursor': 'wait'});
        },
        success: function () {
            $(document.body).css({'cursor': 'default'});
        },
        error: function () {
            alert("Something went wrong!");
            $(document.body).css({'cursor': 'default'});
        }
    })
}