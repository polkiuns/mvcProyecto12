$( document ).ready(function() {
    $("#curso").change(function(event){
    	console.log("/admin/getLesson/"+event.target.value+"");
    	$.get("/admin/getLesson/"+event.target.value+"", function (response, state){
    		console.log(response);
            console.log(state);
    		$("#lesson").empty();
    		$("#lesson").removeAttr('disabled');
    		for(i=0;i<response.length;i++) {
    			$("#lesson").append("<option value='"+response[i].id+"'>"+ response[i].name +"</option>");
    		}
    	});
    });
});