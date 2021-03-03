        <script src="<?=BASE;?>node_modules/jquery/dist/jquery.js"></script>
        <script src="<?=BASE;?>node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="<?=BASE;?>node_modules/bootstrap/dist/js/bootstrap.js"></script>
        <script src="<?=BASE;?>node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="<?=BASE;?>codes/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=BASE;?>codes/js/bootstrap-datepicker.pt-BR.min.js"></script>
        <script src="<?=BASE;?>codes/js/Validator.min.js"></script>
        
        <?php if(filter_input(INPUT_SERVER, 'SCRIPT_NAME') == '/Gestor/index.php'){ ?>
        <script>
            var qnt_result_pg = 9; //quantidade de registro por página
            var pagina = 1; //página inicial
            $(document).ready(function () {
                    listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
            });
            function listar_usuario(pagina, qnt_result_pg){
                var dados = {
                        pagina: pagina,
                        qnt_result_pg: qnt_result_pg
                };
                $.post('<?=BASE;?>Controle/ListarClientes.php', dados , function(retorna){
                        //Subtitui o valor no seletor id="conteudo"
                        $("#TableClientes").html(retorna);
                });
            }
        </script>
        <?php } 
        if(filter_input(INPUT_SERVER, 'SCRIPT_NAME') == '/Inventario/View/Equipamento/Listar.php'){ 
        ?>
        <script>
            var qnt_result_pg = 20; //quantidade de registro por página
            var pagina = 1; //página inicial
            $(document).ready(function () {
                    ListarEquipamentos(pagina, qnt_result_pg); //Chamar a função para listar os registros
            });
            function ListarEquipamentos(pagina, qnt_result_pg){
                var dados = {
                        pagina: pagina,
                        qnt_result_pg: qnt_result_pg,
                        Equipamento: 'Lista'
                };
                $.post('<?=BASE;?>Controle/Equipamentos.php', dados , function(retorna){
                        //Subtitui o valor no seletor id="conteudo"
                        $("#TableEquipamentos").html(retorna);
                });
            }
            function buscaEquipamento(idEquipamento){
                var dados = {idEquipamento: idEquipamento, Equipamento: 'Busca'};
                //alert(idEquipamento);
                $.post('<?=BASE;?>Controle/Equipamentos.php', dados , function(dados){
                    $.each(JSON.parse(dados), function(i, obj){
                        $('#mSequencial').val(obj.CodRegiao+'.'+obj.CodUnidade+'.'+obj.Sequencial);
                        $('#mEquipamento').val(obj.Equipamento);
                        $('#mCategoria').val(obj.Categoria);
                        $('#mSituacao').val(obj.Situacao);
                        $('#mDescricao').val(obj.Descricao);
                        $('#mResponsavel').val(obj.Responsavel);
                        $('#mUnidade').val(obj.Unidade+' - '+obj.Regiao);
                        $('#dEquipamento').val(obj.idEquipamento);
                        $('#sEquipamento').val(obj.idEquipamento);
                    });
                });
                $('#modalEquipamento').modal('show');
            }
            
            $(document).ready(function(){
              $("#sCodigo").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#TableEquipamentos tbody tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
              });
            });
            </script>
        <?php } 
        if(filter_input(INPUT_SERVER, 'SCRIPT_NAME') == '/Gestor/View/Lancamento/Diario.php'){
        ?>
        <script>
            $('#lDate').datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                startDate: '-<?=$U->getPrazo();?>d',
                endDate: "-0 days",
                todayBtn: "linked"
            });
            function SomenteNumero(e){
                var tecla=(window.event)?event.keyCode:e.which;   
                if((tecla>47 && tecla<58)) return true;
                else{
                    if (tecla === 8 || tecla === 0) return true;
                    else  return false;
                }
            }
        </script>
        <?php } 
        if(filter_input(INPUT_SERVER, 'SCRIPT_NAME') == '/Inventario/View/Equipamento/Cadastro.php'){
        ?>
        <script>
            $(document).ready(function() {
                $("#gSequencial").click(function(){
                    var Categoria = $("#Categoria").val();
                    if(Categoria > 0){
                        $.post('Sequencial.inc.php',{Sequencial: 'Gerar', Categoria: Categoria} , function (dados){
                            dados = JSON.parse(dados);
                            if (dados.length > 0){
                                $.each(dados, function(i, obj){
                                    $("#Sequencial").val(obj.Sequencia);
                                });
                            }
                        });
                    }else{
                        $('#ECategoria').modal('show');
                        setTimeout(function() {
                            $('#ECategoria').modal('hide');
                        }, 3000);
                    }
                });
             });
        </script>
        <?php }
        if(filter_input(INPUT_SERVER, 'SCRIPT_NAME') == '/Inventario/View/Equipamento/Solicitacao.php'){
        ?>
        <script>
            function solicitacaoEquipamento(idEquipamento, Tipo){
                var idUnidade = $("#UnidadeDestino").val();
                if(idUnidade > 0){
                    var dados = {idEquipamento: idEquipamento, idUnidade: idUnidade, Tipo: Tipo, Solicitacao: 'Solicitacao', Equipamento: 'Solicitacao'};
                    //alert(dados);
                    $.post('<?=BASE;?>Controle/Solicitacao.php', dados , function(dados){
                        $.each(JSON.parse(dados), function(i, obj){
                            if(obj.Retorno){
                                $('#returnSolicita').html("Solicitação Efetuada com Sucesso!").show();
                            }else{
                                $('#returnSolicita').html("Falha ao gravar solicitação, favor entrar em contato com o Cleiton Teixeira!").show();
                            }
                             $("#modalSolicitacao").modal('show');
                                setTimeout(function() {
                                    $('#modalSolicitacao').modal('hide');
                            }, 5000);
                            
                        });
                    });
                }else{
                    $("#modalErroSelect").modal('show');
                        setTimeout(function() {
                            $('#modalErroSelect').modal('hide');
                    }, 3000);
                }
            }
        </script>
        <?php } ?>
  </body>
</html>


