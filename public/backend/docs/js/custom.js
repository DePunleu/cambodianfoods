// $(document).ready(function(){
//      //Check admin password is correct or not
//     $("#current_password").keyup(function(){
//         var current_password = $("#current_password").val();
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             type:'post',
//             url:'/admin/check_current_password',
//             data:{current_password:current_password},
//             success:function(resp){
//                 if(resp=="false"){
//                     $("#verifyCurrentPwd").removeClass("correct").addClass("incorrect").html("Current Password is Incorrect!");
//                 }else if(resp=="true"){
//                     $("#verifyCurrentPwd").removeClass("incorrect").addClass("correct").html("Current Password is Correct!");
//                 }
//             }, error:function(){
//                 alert("Error");
//             }
//         })
//     })
// });