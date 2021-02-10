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
        if(filter_input(INPUT_SERVER, 'SCRIPT_NAME') == '/Gestor/View/Lancamento/Diario.php'){
        ?>
        <script>
            $('#lDate').datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                startDate: '-<?=$U->getPrazo();?>d',
                endDate: "-0 days",
                todayBtn: "linked",
            });
            function SomenteNumero(e){
                var tecla=(window.event)?event.keyCode:e.which;   
                if((tecla>47 && tecla<58)) return true;
                else{
                    if (tecla==8 || tecla==0) return true;
                    else  return false;
                }
            }
        </script>
        <?php } ?>
  </body>
</html>


