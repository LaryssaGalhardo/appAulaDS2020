$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar nova categoria')

        const datacriacao = new Date().toLocaleString()

        $('.modal-body').load('src/categorias/visao/form-categoria.html', function() {
            $('#dataagora').val(datacriacao)
        })

        $('.btn-save').show()
        $('.btn-update').hide()

        $('#modal-categoria').modal('show')
    })
    $('.btn-save').click(function(e) {
        e.preventDefault()

        let dados = $('#form-categoria').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/categorias/modelo/create-categoria.php',
            success: function(dados) {
                Swal.fire({
                    title: 'appAulaDS',
                    text: dados.mensagem,
                    type: dados.tipo,
                    confirmButtonText: 'OK'
                })

                $('#modal-categoria').modal('hide')
                $('#table-categoria').DataTable().ajax.reload()
            }
        })
    })
})
