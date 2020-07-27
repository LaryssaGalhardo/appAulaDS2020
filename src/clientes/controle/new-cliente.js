$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar novo cliente')

        const datacriacao = new Date().toLocaleString()

        $('.modal-body').load('src/clientes/visao/form-cliente.html', function() {
            $('#dataagora').val(datacriacao)
        })

        $('.btn-save').show()
        $('.btn-update').hide()

        $('#modal-cliente').modal('show')
    })
    $('.btn-save').click(function(e) {
        e.preventDefault()

        let dados = $('#form-cliente').serialize()

        $('input[type=checkbox]').each(function() {
            if (!this.checked) {
                dados += '&' + this.name + '=off'
            }
        })

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/cliente/modelo/create-cliente.php',
            success: function(dados) {
                Swal.fire({
                    title: 'appAulaDS',
                    text: dados.mensagem,
                    type: dados.tipo,
                    confirmButtonText: 'OK'
                })

                $('#modal-cliente').modal('hide')
                $('#table-cliente').DataTable().ajax.reload()
            }
        })
    })
})
