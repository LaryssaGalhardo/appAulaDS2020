(document).ready(function() {
    $('.btn-new'.click(function(e){
    e.preventDefault()

    $('.modal-title').empty();
    $('.modal-body').empty();

    $('.modal-title').append('Adicionar nova categoria');

    $('.modal-body').load('src/categorias/visao/form-categoria.html');

    $('.btn-save').show();

    $(modal); })
}
