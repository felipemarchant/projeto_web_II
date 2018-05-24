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
		var arr = [];
		getSelectedOptions(this.elements["materia"]).forEach(function(o){
			arr.push(o.value);
		});
		dados.aluno.materia = arr;

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

	var formEditAluno = document.getElementById('formAluno_edit');
	formEditAluno.addEventListener("submit", function(e){
		e.preventDefault();
		var dados = {};

		dados.aluno = {};
		dados.aluno.id = this.elements['_id'].value;
		dados.aluno.nome = this.elements["nome"].value;
		dados.aluno.sobrenome = this.elements["sobrenome"].value;

		dados.usuario = {};
		dados.usuario.email = this.elements["email"].value;
		dados.usuario.senha = this.elements["senha"].value;
		dados.usuario.ra = this.elements["ra"].value;

		var self = this;
		eHTTP = new easyHTTP();
		eHTTP.post('ajax/alunoRepository_edit.php', dados, function(err, data){
				alert('Aluno editado com Sucesso!');
				location.reload();
		});
		return false;
	});

};
function hideEdit(){
	document.getElementById('alunoForm_edit_all').style.display = 'none';
	document.getElementById('alunoForm_add_all').style.display = 'block';
}
function showEdit(){
	document.getElementById('alunoForm_edit_all').style.display = 'block';
	document.getElementById('alunoForm_add_all').style.display = 'none';
}
function getSelectedOptions(sel, fn) {
    var opts = [], opt;
    for (var i=0, len=sel.options.length; i<len; i++) {
        opt = sel.options[i];
        if ( opt.selected ) {
            opts.push(opt);
            if (fn) {
                fn(opt);
            }
        }
    }
    return opts;
}