<input type="text" name="nome" value="{{ old('nome') }}" class="borda-preta @error('nome') is-invalid @enderror" placeholder="Nome">
@error('nome')
    <div><li style="color: red">{{ $message }}</li></div>
@enderror

<input type="text" name="site" value="{{ old('site') }}" class="borda-preta @error('site') is-invalid @enderror" placeholder="Site">
@error('site')
    <div><li style="color: red">{{ $message }}</li></div>
@enderror

<input type="text" name="uf" value="{{ old('uf') }}" class="borda-preta @error('uf') is-invalid @enderror" placeholder="UF">
@error('uf')
    <div><li style="color: red">{{ $message }}</li></div>
@enderror

<input type="text" name="email" value="{{ old('email') }}" class="borda-preta" placeholder="E-mail">
{{ $errors->has('email') ? $errors->first('email') : '' }}

<button type="submit">
    {{ $nome }}
</button>
