$(document).ready(function() {

    $('#table-cliente').on('click', 'button.btn-view', function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Visualização do cliente')

        let idcategoria = `idcliente=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            assync: true,
            data: idcategoria,
            url: 'src/clientes/modelo/view-cliente.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/clientes/visao/form-cliente.html', function() {
                        $('#nome').val(dado.dados.nome)
                        $('#nome').attr('readonly', 'true')
                        $('#dataagora').val(dado.dados.datacriacao)

                        if (dado.dados.ativo == "N") {
                            $('#ativo').removeAttr('checked')
                        }

                        $('#ativo').attr('readolnly', 'true')

                    })
                    $('.btn-save').hide()
                    $('.btn-update').hide()
                    $('#modal-cliente').modal('show')
                } else {
                    Swal.fire({
                        title: 'appAulaDS',
                        text: dado.mensagem,
                        type: dado.tipo,
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })

})