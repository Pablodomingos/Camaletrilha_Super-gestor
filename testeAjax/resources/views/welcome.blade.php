<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form style="display: flex;flex-direction:column; align-items:center" id="formulario" name="formCreate" enctype="multipart/form-data">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="file" id="arquivo" name="arquivo">
        <a id="enviar" style="width: 150px;background-color:aquamarine; text-align:center; margin-top: 20px">enviar</a>
        <button>teste</button>
    </form>
</body>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

<script>
    $(document).ready(function($) {
        const btn = document.querySelector('#enviar');
    	// Evento Submit do formulário
        btn.addEventListener('click',function(e){
                e.preventDefault();

                // // Captura os dados do formulário
                var formulario = document.getElementById('formulario');

                // // Instância o FormData passando como parâmetro o formulário
                var formData = new FormData(formulario);

                // Envia O FormData através da requisição AJAX
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('store') }}",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType:false,
                    cache:false,
                    processData: false,
                    contentType: false,
                    success: function(retorno){
                           console.log(retorno);
                       }
                });


        });

    });
</script>

{{-- <script>
    $(function(){
        $('form[name="formCreate"]').on('submit', function(e){
            e.preventDefault();
            var input = $(this).find('input#arquivo');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('store') }}",
                type:"POST",
                data: input,
                // dataType:"json",
                success: function(response){
                    console.log(response);;
                }
            });
        });
    });
</script> --}}

</html>
