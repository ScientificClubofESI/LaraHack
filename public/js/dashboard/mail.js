
 function sendMail(element, mailType) {
     swal({
         title : "Are you sure to send mails ?" ,
         text: "Once sent, you will not be able to redo!",
         icon :"warning" ,
         buttons : true , 
     }) 
     .then((willSend) => { 
         if (willSend) {
            $.ajax({
            headers:{'X-CSRF-TOKEN': token},
            type:"POST",
            url: route ,
            dataType:'json',
            data: JSON.stringify({MailType : mailType}),
            contentType:false,
            processData:false,
            beforeSend: function () {
                element.innerHTML = '<svg class="spinner" width="15px" height="15px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"> <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle> </svg>';                    
            },
            success: function (json) {
                //set the changes
                if (json.response) {                        
                }
                $(document.body).css({'cursor': 'default'});
                element.innerHTML = '<i class="fas fa-envelope"></i>';
                swal ( "Done !" ,  "Mails are being sent , it can takes some minutes ." ,  "success" );
            },
            error: function (response) {
                if (response.status === 401) //redirect if not authenticated user.
                    window.location = '/errors/401';
                else if (response.status === 422) {
                } else {
                }
                $(document.body).css({'cursor': 'default'});
                element.innerHTML = '<i class="fas fa-envelope"></i>';
                swal ( "Oops" ,  "Something went wrong!" ,  "error" )
            }
        })
         } else {
            swal("You havn't send any mail !");
         }
     })
   
 }