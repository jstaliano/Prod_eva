<?php
session_start();
require_once 'init.php';
session_checker();
$log = isLoggedIn();
if ($log == '1') :
    require 'conexao.php';
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    $msg = '';
    $msg .= '            <table class="table table-sm table-striped table-hover" style="margin-top: 25px;">';
    $msg .= '                    <tr class="table-active">';
    $msg .= '                    <th>Foto do Produto</th>';
    $msg .= '                    <th>Código Produto</th>';
    $msg .= '                    <th>NCM do Produto</th>';
    $msg .= '                    <th></th>';
    $msg .= '                    <th>Preço</th>';
    $msg .= '                    <th>Fornecedor</th>';
    $msg .= '                    <th>Categoria</th>';
    $msg .= '                    <th>Descrição do Produto</th>';
    $msg .= '                    <th>Ações P/ Este Produto</th>';
    $msg .= '                </tr>';
    require_once('conexao.php');
    $conexao = conexao::getInstance();
    try {
        if (empty($parametro)) :
            $sql = "SELECT ProductId,ProductCode,ProductNCM,ProductPrice,ProductSupplier,ProductName,ProductImage,ProductCategoryId FROM products ORDER BY ProductCode ASC";
        else :
            $sql = "SELECT ProductId,ProductCode,ProductNCM,ProductPrice,ProductSupplier,ProductName,ProductImage,ProductCategoryId FROM products WHERE ProductName LIKE '%$parametro%' ORDER BY ProductCode ASC";
        endif;
        $stm = $conexao->prepare($sql);
        $stm->execute();
        $products = $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if (count($products)) :
        clearstatcache();
        foreach ($products as $product) :
            $idcat = $product->ProductCategoryId;
            $sql = "SELECT CategoryName FROM categories WHERE CategoryId = $idcat";
            $stm = $conexao->prepare($sql);
            $stm->execute();
            $categories = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($categories as $category) {
                $cat = $category->CategoryName;
            }
            $msg .= '</tr>';
            $msg .= '<td style="display:none;" >' . $product->ProductId . '</td>';
            $msg .= '<td style="display:none;" >' . $product->ProductImage . '</td>';
            $msg .= '<td ><img src="./fotos/' . $product->ProductImage . '" width="180"></td>';
            $msg .= '<td style="font-size:28px; align:Center; Color:#dc3545;" >' . str_pad($product->ProductCode, 8, "0", STR_PAD_LEFT) . '</td>';
            $msg .= '<td >' . $product->ProductNCM . '</td>';
            $msg .= '<td >R$</td>';
            $msg .= '<td >' . str_replace('.',',',$product->ProductPrice) . '</td>';
            $msg .= '<td >' . $product->ProductSupplier . '</td>';
            $msg .= '<td style="display:none;">' . $product->ProductCategoryId . '</td>';
            $msg .= '<td >' . $cat . '</td>';
            $msg .= '<td >' . $product->ProductName . '</td>';
            if ($_SESSION['nivel'] >= 0) :
                $msg .= '<td><button type="button" id="editbtn" class="btn btn danger editbtn"><i class="fas fa-edit" style="font-size: 30px; color:   Dodgerblue;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="editbtn" class="btn btn danger deletebtn"><i class="fas fa-trash" style="font-size:30px;color:red;"></i></button></td>';
            else :
                $msg .= '<td><i class="fas fa-ban" style="font-size: 20px; color:red;"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-banh" style="font-size: 20px; color: red;"></i></td>';
            endif;
            $msg .= '</tr>';
        endforeach;
        $msg .= '        </table>';
    else :
        $msg = "";
        echo "<div class='alert alert-warning text-center' style='margin-top:25px;' role='alert'><h4>Nenhum Produto Encontrado Com Essa Descrição!</h4> </div> ";
    //$msg .="Nenhum Produto foi encontrado...";
    endif;
    echo $msg;
endif;
?>

<script>
    $(document).ready(function() {

        function liberacampos() {
            $('#updateproduct').attr('disabled', false)
            $('#ucodigo').focus()
            $('#uncm').attr('disabled', false)
            $('#unome').attr('disabled', false)
            $('#ucategoria').attr('disabled', false)
            $('#uimg').attr('disabled', false)
            //$('#ucodigo').val('0')
            //////console.log('Liberado')                                
            //$("#ucodigo").attr("placeholder", "Código já Cadastrado");

        }

        function dados(val, idc, page, acao) {
            //console.log(val)
            var retorno
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: page,
                data: val + '&' + idc,
                success: function(msg) {
                    var res = msg                    
                    retorno = msg                                           
                    if (res == "Achei") {                        
                        if (acao == 'incluir') {
                            $('#alert').html("<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Cadastro Atualizado com sucesso !!!</h4> </div>")
                            //$('#codigo').val('0')
                            $('#codigo').focus()
                            $('#ncm').attr('disabled', true)
                            $('#nome').attr('disabled', true)
                            $('#categoria').attr('disabled', true)
                            $('#img').attr('disabled', true)
                            $('#salvainclusao').attr('disabled', true)
                            $("#codigo").attr("placeholder", "Código já Cadastrado");
                        } else {
                            $('#updateproduct').attr('disabled', true)
                            alert('Este Código já Existe')
                            //$('#ucodigo').val()
                            //console.log($('#ucodigo'))
                            $('#ucodigo').focus()
                            $('#uncm').attr('disabled', true)
                            $('#unome').attr('disabled', true)
                            $('#ucategoria').attr('disabled', true)
                            $('#uimg').attr('disabled', true)
                            $("#ucodigo").attr("placeholder", "Código já Cadastrado");
                        }
                    } else {
                        if (acao == 'incluir') {
                            $('#ncm').attr('disabled', false)
                            $('#nome').attr('disabled', false)
                            $('#categoria').attr('disabled', false)
                            $('#img').attr('disabled', false)
                            $('#salvainclusao').attr('disabled', false)
                            $('#ncm').focus()
                        } else {
                            //console.log($('#ucodigo').val())
                            $('#uncm').attr('disabled', false)
                            $('#unome').attr('disabled', false)
                            $('#ucategoria').attr('disabled', false)
                            $('#uimg').attr('disabled', false)
                            $('#updateproduct').attr('disabled', false)
                            $('#uncm').focus()
                        }
                    }                    
                }                 
            });
            return retorno
            
        }
        //dados(null, './funcoes/pesquisa.php', '#codigo');
        $('#codigo').change(function() {            
            var val = $('#ucodigo').serialize()
            var idc = $('#uidcodigo').serialize() 
            var $param = $(this).val();
            if ($param.length >= 1) {
                dados(val,idc, './funcoes/pesquisa.php', 'incluir')
            }
        });
        $('.deletebtn').on('click', function() {
            $('#deletemodal').modal('show')
            $tr = $(this).closest('tr')
            var data = $tr.children("td").map(function() {
                return $(this).text()
            }).get();           
            $('#didcodigo').val(data[0])
            $('#dcodigo').val(data[3])
            $('#dnome').val(data[6])
            $('#dfoto').val(data[1])
            $("#dmy_image").attr("src", "./fotos/" + data[1])
        });

        $('#ucodigo').change(function() {
            var val = $('#ucodigo').serialize()
            var idc = $('#uidcodigo').serialize()            
            var $param = $(this).val();
            if ($param.length >= 1) {
                dados(val,idc, './funcoes/pesquisa.php', 'update')
            }
        });

        $('#ucodigo').on("keypress", function(e) {
            if (e.keyCode == 13) {
                var inputs = $(this).parents("form").eq(0).find(":input");
                var idx = inputs.index(this);
                //dados(val + '&' + idc, './funcoes/pesquisa.php', 'update')
                if (idx == inputs.length - 1) {
                    inputs[0].select()
                } else {
                    inputs[idx + 1].focus(); //handles submit buttons
                    inputs[idx + 1].select();
                }
                return false;
            }
        });

        $('.editbtn').on('click', function() {            
            $('#editmodal').modal('show')
            $tr = $(this).closest('tr')
            var data = $tr.children("td").map(function() {
                return $(this).text()
            }).get();
            console.log(data)
            var val = $('#ucodigo').val(data[3]).serialize()
            var idc = $('#uidcodigo').val(data[0]).serialize()            
            AnalizaTeclas()
            dados(val,idc, './funcoes/pesquisa.php', 'update')
            $('#uidcodigo').val(data[0])
            $('#ucodigo').val(data[3]) //.mask("00000000", { placeholder: "0", autoclear: false });
            $('#uncm').val(data[4])
            $('#uprice').val(data[6])
            $('#usupplier').val(data[7])
            $('#unome').val(data[10])
            $('#ucategoria').val(data[8])
            $('#uimg').val(data[2])
            $('#ufoto').val(data[1])
            $("#my_image").attr("src", "./fotos/" + data[1])

        });
    });
</script>
<script language="JavaScript">
    function AnalizaTeclas() {
        var tecla = window.event.keyCode;
        if (tecla == 13) {
            event.keyCode = 0;
            event.returnValue = false;
        }
    }
    //-->
</script>
<!--<body onKeyDown="AnalizaTeclas()"> -->