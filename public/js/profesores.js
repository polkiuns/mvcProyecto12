$( document ).ready(function() {
    $("#asignatura").change(function(event){
    	$("#asignatura option[value='']").remove();
    	console.log("/admin/getProfesor/"+event.target.value+"");
    	$.get("/admin/getProfesor/"+event.target.value+"", function (response, state){
    		console.log(response);
            console.log(state);
    		$("#profesor").empty();
    		$("#profesor").removeAttr('disabled');
    		for(i=0;i<response.length;i++) {
    			$("#profesor").append("<option value='"+response[i].id+"'>"+ response[i].nombre +"</option>");
    		}
    	});
    });
});