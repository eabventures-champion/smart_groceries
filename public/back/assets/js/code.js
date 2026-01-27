$(function () {
    $(document).on('click', '#delete', function (e) {
       e.preventDefault();
       var link = $(this).attr("href");
       Swal.fire({
          title: 'Are you sure?',
          text: "Delete This Data?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
       }).then((result) => {
          if (result.isConfirmed) {
             window.location.href = link
             Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
             )
          }
       })
    });
 });
 
 
 /// Confirm Order 
 $(function () {
    $(document).on('click', '#confirm', function (e) {
       e.preventDefault();
       var link = $(this).attr("href");
       Swal.fire({
          title: 'Are you sure to Confirm?',
          text: "Once Confirm, it moves to processing?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Confirm!'
       }).then((result) => {
          if (result.isConfirmed) {
             window.location.href = link
             Swal.fire(
                'Confirm!',
                'Confirm Change',
                'success'
             )
          }
       })
    });
 });
 /// End Confirm Order
 
 /// Processing Order 
 $(function () {
    $(document).on('click', '#processing', function (e) {
       e.preventDefault();
       var link = $(this).attr("href");
 
 
       Swal.fire({
          title: 'Are you sure to Processing?',
          text: "Once Processing, item is ready to be delivered?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Processing!'
       }).then((result) => {
          if (result.isConfirmed) {
             window.location.href = link
             Swal.fire(
                'Processing!',
                'Processing Change',
                'success'
             )
          }
       })
 
 
    });
 
 });
 /// Eend Processing Order 
 
 
 /// Delivered Order 
 $(function () {
    $(document).on('click', '#delivered', function (e) {
       e.preventDefault();
       var link = $(this).attr("href");
 
 
       Swal.fire({
          title: 'Are you sure to Delivered?',
          text: "Once Delivered, Customer receives item?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Delivered!'
       }).then((result) => {
          if (result.isConfirmed) {
             window.location.href = link
             Swal.fire(
                'Delivered!',
                'Delivered Change',
                'success'
             )
          }
       })
 
 
    });
 
 });
 /// End Delivered Order

 /// Return Approved Order 
$(function(){
   $(document).on('click','#approved',function(e){
       e.preventDefault();
       var link = $(this).attr("href");


                 Swal.fire({
                   title: 'Are you sure to Approved?',
                   text: "Return Order Approved",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, Approved!'
                 }).then((result) => {
                   if (result.isConfirmed) {
                     window.location.href = link
                     Swal.fire(
                       'Approved!',
                       'Approved Change',
                       'success'
                     )
                   }
                 }) 

               });
   });

   // Product Attributes Add/Remove script
   var maxField = 10; //Input fields increment limitation
   var addButton = $('.add_button');
   var wrapper = $('.field_wrapper');
   var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" placeholder="size" style="width: 120px;"/>&nbsp;<input type="text" name="sku[]" placeholder="sku" style="width: 120px;"/>&nbsp;<input type="text" name="price[]" placeholder="price" style="width: 120px;"/>&nbsp;<input type="text" name="stock[]" placeholder="stock" style="width: 120px;"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>';
   var x = 1;
   
   // Once add button is clicked
   $(addButton).click(function(){
       //Check maximum number of input fields
       if(x < maxField){ 
           x++; //Increase field counter
           $(wrapper).append(fieldHTML); //Add field html
       }else{
           alert('A maximum of '+maxField+' fields are allowed to be added. ');
       }
   });

   // Once remove button is clicked
   $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
      $(this).parent('div').remove(); //Remove field html
      x--; //Decrease field counter
  });

// $(function(){
//   $(document).on("click",".update_attribute_status",function(){
//    var status = $(this).children("i").attr("status");
//    var attribute_id = $(this).attr("attribute_id");
//    alert(status);
//    $.ajax({
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        },
//        type: 'post',
//        url: '/admin/update-attribute-status',
//        data: {status:status, attribute_id:attribute_id},
//        success:function(resp){
//            if(resp['status'] == 0){
//                $("#attribute-"+attribute_id).html("<i style='font-size: 25px;' class='fa-solid fa-thumbs-down' status='InActive'></i>");
//            }else if(resp['status'] == 1){
//                $("#attribute-"+attribute_id).html("<i style='font-size: 25px;' class='fa-solid fa-thumbs-up' status='Active'></i>");
//            }
//        },error:function(){
//            alert("Error");
//        }
//       })
//    });
// });   

