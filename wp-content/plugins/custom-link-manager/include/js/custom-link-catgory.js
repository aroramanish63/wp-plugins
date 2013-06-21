//
//jQuery(document).ready(function($){
//    
//    $("#save_cat").live("click", function(){
//            if(custom_linkvalidation()){
////                    searchform($('#propertysearch').serialize(), $('#propertysearch').parent().parent());
////                    return false;
//                $('#propertysearch').submit();
//            }
//            return false;
//	}
//    )
////   $('#property_search').click(function(){
////       if(property_searchvalidation()){
////            $('#propertysearch').submit();
////       }
////       return false;
////   });
//   
//   
//    function custom_linkvalidation(){
//                    $("#msg").empty();
//                    var property_type=$.trim($("#property_type").val()); 
//                    var prolocation=$.trim($("#prolocation").val());
//
//                    var property_typev,prolocationv;
//
//                    jQuery("#msg").empty();
//                    if((property_type=='') || (property_type.replace(/\s+$/, '') == '')){
//                        var property_message='<p style="color:#ff0000; margin-bottom:0;">* Property Type is required field</p>';
//                        jQuery("#msg").append(property_message);
//                    }else{
//                        property_typev=true;
//                    }
//                    if((prolocation=='') || (prolocation.replace(/\s+$/, '') == '')){
//                        var loc_message='<p style="color:#ff0000; margin-bottom:0;">* Property Location required field</p>';
//                        jQuery("#msg").append(loc_message);
//                    }else{
//                        prolocationv=true;
//                    }
//                    
//                    if( property_typev && prolocationv){ 
//                        return true;
//
//                    }else{
//                        return false;
//                    }
//
//                    return false;
//        }
//                
////        function searchform(test,test1){
//////                console.log(test);
//////                console.log(test1);
////                var profileForm = test1,
////				dataPost = test;
////                            profileForm.find("#msg").html("Processing...");
////			$.ajax({
////				url:profileForm.attr("action"),
////				type: "POST",
////				data:dataPost,
////		        success: function(data){
////	    			window.location.hash = window.location.hash+"?"+parseInt(Math.random()*10);
//////                                    profileForm.find("#msg").html("Profile Updated");
////                                    profileForm.find("#msg").html("Updated.");
////				},
////				error:function(data){
////                                    
////				}
////			})
////        }                
//   
//});

jQuery(document).ready(function($) {
	$('#customsubmit').click(function () {
		$.post(ajax_object.ajaxurl, {
			action: 'ajax_action',
			cat_name: $(this).find('input#customcategory').attr('value'),
                        cat_desc: $(this).find('input#cat_desc').attr('value'),
		}, function(data) {
			alert(data); // alerts 'ajax submitted'
		});
	});
});