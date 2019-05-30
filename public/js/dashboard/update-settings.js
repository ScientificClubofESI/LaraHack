     function updateSettings(element) {
         if ( $('#registration').prop("checked") ) {
            var registrationMode = 'open'
         } else {
            var registrationMode = 'closed'
         }
         swal({
             title : "Are you sure to Update Settings ?" ,
             icon :"warning" ,
             buttons : true ,
         })
         .then((willUpdate) => {
             if (willUpdate) {
                $.ajax({
                headers:{'X-CSRF-TOKEN': token},
                type:"POST",
                url: `/admin/settings/${registrationMode}`,
                dataType:'json',
                contentType:false,
                processData:false,
                beforeSend: function () {
                },
                success: function (json) {
                    //set the changes
                    if (json.response) {
                    }
                    swal ( "Done !" ,  "Settings Updated Sucessefully" ,  "success" );
                },
                error: function (response) {
                    if (response.status === 401) //redirect if not authenticated user.
                        window.location = '/errors/401';
                    else if (response.status === 422) {
                    } else {
                    }
                    swal ( "Oops" ,  "Something went wrong!" ,  "error" )
                }
            })
             } else {
                swal("You havn't updated any setting !");
             }
         })

     }