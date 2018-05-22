window.onload = function(){

};
function findOnly(id){
	eHTTP = new easyHTTP();
	eHTTP.post('../ajax/alunoRepository_findOnly.php', {"id":id} ,function(error, data){
		var data = JSON.parse(data);
		console.log(data);
	});
}