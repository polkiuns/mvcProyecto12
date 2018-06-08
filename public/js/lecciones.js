$( document ).ready(function() {
    $("#subject").change(function(event){
    	console.log("/dynamicselects/getLesson/"+event.target.value+"");
    	$.get("/dynamicselects/getLesson/"+event.target.value+"", function (response, state){
            for(i=0;i<response.length;i++) {
                console.log('ok');
            }   		
            console.log(state);
    	});
    });
});