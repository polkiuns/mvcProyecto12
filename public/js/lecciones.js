$( document ).ready(function() {
    $("#curso").change(function(event){
    	console.log("/admin/getLesson/"+event.target.value+"");
    	$.get("/admin/getLesson/"+event.target.value+"", function (response, state){
    		console.log(response);
            console.log(state);

    		$("#lesson").empty();
    		$("#lesson").removeAttr('disabled');
    		$("#lesson").append("<option value='0'>No pertenecer a una leccion</option>");
    		if(response.length > 1){
            for(i=0;i<response.length;i++) {
                $("#lesson").append("<option value='"+response[i].id+"'>"+ response[i].name +"</option>");
            }                
        }else {
            for(i=0;i<100000;i++){
                if(response[i] != null){
                $("#lesson").append("<option value='"+response[i].id+"'>"+ response[i].name +"</option>");                    
                }
            }
            
        }

    	});
    });
});