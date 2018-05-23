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
		var self = this;
		eHTTP = new easyHTTP();
		eHTTP.post('ajax/professorRepository_add.php', dados, function(err, data){
			var data = JSON.parse(data);
			if(data.erro_ra){
				alert(data.erro_ra);
				self.elements["ra"].value = data.ra;
			}else{
				alert('Professor cadastrado com Sucesso!');
				location.reload();
			}
		});
		return false;
	});
};
function hideEdit(){
	document.getElementById('formProfessor_edit_all').style.display = 'none';
	document.getElementById('formProfessor_add_all').style.display = 'block';
}
function showEdit(){
	document.getElementById('formProfessor_edit_all').style.display = 'block';
	document.getElementById('formProfessor_add_all').style.display = 'none';
}

