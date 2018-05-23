window.onload = function(){
	var bodyId = document.body.id;

	if(bodyId == 'admin_professor'){
		urls = {};
		urls.fetchTable = 'ajax/professorRepository_getCollection.php';
	}
	if(urls){
		dataTable.init(urls);
		formSearch.init(dataTable);
	}
	var formAddProfessor = document.getElementById("formProfessor_add");
	formAddProfessor.addEventListener("submit", function(e){
		e.preventDefault();
		var dados = {};
		dados.usuario = {
			ra:this.elements["ra"].value,
			email:this.elements["email"].value,
			senha:this.elements["senha"].value
		};
		dados.professor = {
			nome:this.elements["nome"].value,
			sobrenome:this.elements["sobrenome"].value,
			materia:this.elements["materia"].value
		};
		eHTTP = new easyHTTP();
		eHTTP.post('ajax/professorRepository_add.php', dados, function(err, data){
			if(!data){
				alert('Professor cadastrado com Sucesso!');
				location.reload();
			}
		});
		return false;
	});
};
