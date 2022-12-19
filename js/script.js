$(function() {

    let btnSimular = $('button[name="simular"]');
    
    $("input#valor").maskMoney({
        prefix:'R$ ', 
        thousands:'.', 
        decimal:',', 
        affixesStay: false
    });

    $("input#juros").maskMoney({
        prefix:'%', 
        decimal:'.', 
        affixesStay: false
    });
    
    ($('tbody#resultado').val() == '') ? $('tbody#resultado').html('<tr><td colspan="4" align="center">Nenhuma consulta realizada</td></tr>') : '';

    $('form').keypress(function (e) { 
        if(e.keyCode == 13) return false;     
    });

    btnSimular.on('click', function(e){
        e.preventDefault();
        let parcelas = $('select[name=parcelas]').val();
        let valor = $('input#valor').val();
        let juros = $('input#juros').val();

        if (valor == '' || juros == ''){
            messsageError('Preencha os campos, por favor!!');
            return false;
        } 
        
        let valorLimite = valor.replace('.', '');

        if (parseInt(valorLimite) < 100){
            messsageError('É permitido apenas valores acima de R$ 100,00. Verifique!');
            return false;
        }


        $.ajax({
            beforeSend: function() {
                loadingProgress();
                $('tbody#resultado > tr').remove();
            },
            type: "post",
            url: "./controller/contability.php",
            data: {valor: valor, parcelas: parcelas, juros: juros},
            dataType: "json",
            success: function (resp) {

                setTimeout(()=>{
                    unLoadingProgress();
                    
                    let html = '';
                    let n = 1;
                    
                    for (let i = 0; i < resp.length; i++) {
                        
                        let jurosMes = String(resp[i][1]).replace('.', ',');
                        let valor = String(resp[i][0]).replace('.', ',');
                        html = `
                        <tr>
                            <td>${n++}</td>
                            <td>${juros}%</td>
                            <td>${jurosMes}</td>
                            <td>R$ ${valor}</td>
                        </tr>`;

                        $('tbody#resultado').append(html);
                    }

                }, 1000);
            }
        });
    });
});

function loadingProgress(){

    let loading = `<button id="loading"></button>`;
    $('body').append(loading);
}

function unLoadingProgress(){

    $('button#loading').remove();
}

function messsageError(message) { 

    let messageError = `<div class="msg-error">
                            <div>
                                <h3>${message}</h3>
                            </div>

                            <button id="close-error">Fechar</button>
                        </div>`;
    
    $('body').append(messageError);

    $('button#close-error').click(function(){
        $('div.msg-error').remove();
    });
}