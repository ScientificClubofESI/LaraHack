'use strict';

        function setdecision(element, member_id, decision) {

            let formData = new FormData();
            formData.append('_token', token);
            formData.append('id', member_id);
            formData.append('decision', decision);
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: "POST",
                url: `/admin/hackers/${member_id}`,
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
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
                    alert("Something went wrong!");
                    $(document.body).css({'cursor': 'default'});
                }
            })
        }
