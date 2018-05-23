window.onload = function(){
	var bodyId = document.body.id;

	if(bodyId == 'admin_aluno'){
		urls = {};
		urls.fetchTable = 'ajax/alunoRepository_getCollection.php';
	}
	if(urls){
		dataTable.init(urls);
		formSearch.init(dataTable);
	}

	var formAddAluno = document.getElementById("formAluno_add");
	formAddAluno.addEventListener("submit", function(e){
		e.preventDefault();
		var dados = {};
		dados.usuario = {
			ra:this.elements["ra"].value,
			email:this.elements["email"].value,
			senha:this.elements["senha"].value
		};
		dados.aluno = {
			nome:this.elements["nome"].value,
			sobrenome:this.elements["sobrenome"].value,
		};
		var self = this;
		eHTTP = new easyHTTP();
		eHTTP.post('ajax/alunoRepository_add.php', dados, function(err, data){
			var data = JSON.parse(data);
			if(data.erro_ra){
				alert(data.erro_ra);
				self.elements["ra"].value = data.ra;
			}else{
				alert('Aluno cadastrado com Sucesso!');
				location.reload();
			}
		});
		return false;
	});

};
function hideEdit(){
	document.getElementById('formAluno_edit_all').style.display = 'none';
	document.getElementById('formAluno_add_all').style.display = 'block';
}
