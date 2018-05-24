window.onload = function(){

};
function findOnly(id){
	eHTTP = new easyHTTP();
	eHTTP.post('../ajax/alunoRepository_findOnly.php', {"id":id} ,function(error, data){
		var data = JSON.parse(data);
		console.log(data);
		var tbodyPresenca = document.getElementById('tbody_presenca');
		var pNome = document.getElementById('aluno_nome');
		var pSobrenome = document.getElementById('aluno_sobrenome');
		var pRa = document.getElementById('aluno_ra');
		var pEmail = document.getElementById('aluno_email');

		var aluno = data.aluno;
		pNome.innerHTML = aluno.alu_nome;
		pSobrenome.innerHTML = aluno.alu_sobrenome;
		pRa.innerHTML = aluno.usu_ra;
		pEmail.innerHTML = aluno.usu_email;
		document.getElementById('_id_alu').value = aluno.alu_id;

		tbodyPresenca.innerHTML = null;
		if(data.frequencia.length > 0){		
			data.frequencia.forEach(function(f){
				var html = '<tr>';
					html += '<td>'+f.fre_data+'</td>';
					var presenca = (parseInt(f.fre_presenca) == 1)? 'Presente':'Faltou';
					html += '<td>'+presenca+'</td>';
					html += '</tr>';
					tbodyPresenca.insertAdjacentHTML('beforeend',html);
			});
		}


	});
}
function insertAluPresencaNota(){
	var id = document.getElementById('_id_alu').value,
		matId = document.getElementById('_id_mat').value;
	var presenca = document.getElementById('select_presente').value,
		dateHJ = document.getElementById('_dataAtual').value;

	var dados = {
		id : id,
		matId : matId,
		presenca : presenca,
		dateHJ: dateHJ
	};
	if(id){
		eHTTP = new easyHTTP();
		eHTTP.post('../ajax/updateFrequencia.php', dados ,function(error, data){
			var data = JSON.parse(data);
			if(data.s){
				location.reload();
			}
		});
	}
}