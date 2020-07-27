$(document).ready(function() {

    $('#table-cliente').on('click', 'button.btn-edit', function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Edição cliente')

        let idcategoria = `idcliente=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            assync: true,
            data: idcategoria,
            url: 'src/cliente/modelo/view-cliente.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/clientes/visao/form-cliente.html', function() {
                        $('#nome').val(dado.dados.nome)
                        $('#telefone').val(dado.dados.telefone)
                        $('#email').val(dado.dados.email)
                        $('#dataagora').val(dado.dados.datacriacao)

                        if (dado.dados.ativo == "N") {
                            $('#ativo').removeAttr('checked')
                        }

                        $('#idcategoria').val(dado.dados.idcategoria)

                    })
                    $('.btn-save').hide()
                    $('.btn-update').show()
                    $('#modal-categoria').modal('show')
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