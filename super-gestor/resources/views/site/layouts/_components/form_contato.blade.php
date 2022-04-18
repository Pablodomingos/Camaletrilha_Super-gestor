{{ $slot }}
<form action={{ route('salvar') }} method="POST">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
    {{ $errors->any('nome') ? $errors->first('nome') : '' }}
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="{{ $classe }}">
    {{ $errors->any('telefone') ? $errors->first('telefone') : '' }}
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
    {{ $errors->any('email') ? $errors->first('email') : '' }}
    <br>
    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        @foreach($opcoes as $motivo_do_contato)
            <option value="{{ $motivo_do_contato->id }}" {{ old('motivo_contatos_id') == $motivo_do_contato->id ? 'selected' : '' }}>{{ $motivo_do_contato->motivo_contato }}</option>
        @endforeach
    </select>
    {{ $errors->any('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : '' }}
    <br>
    <textarea name="mensagem" class="{{ $classe }}" placeholder="Preencha aqui a sua mensagem!">{{ old('mensagem') ? old('mensagem') : '' }}</textarea>
    {{ $errors->any('mensagem') ? $errors->first('mensagem') : '' }}
    <br>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>
