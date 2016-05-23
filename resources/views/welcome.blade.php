<form action="{{route('banner.cadastrar')}}" method="post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
            <label>Titulo</label>
            <input name="titulo" value="{{old('titulo')}}" class="form-control">
            @if ($errors->has('titulo'))
                <span class="help-block">
						<strong>{{ $errors->first('titulo') }}</strong>
					</span>
            @endif
        </div>

        <div class="col-md-6">
            <div class=" form-group {{ $errors->has('imagem') ? ' has-error' : '' }}">
                <label>Imagem de Capa</label>
                <input type="file" name="imagem" accept="image/jpg,image/jpeg,image/bmp,image/png,image/gif">
                @if ($errors->has('imagem'))
                    <span class="help-block">
							<strong>{{ $errors->first('imagem') }}</strong>
						</span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('ativo') ? ' has-error' : '' }}">
                <label>Ativo<i class="fa fa-eyer"></i></label>
                <select name="ativo" id="ativo" class="form-control">
                    <option value="" selected>Sim ou Não</option>
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
                @if ($errors->has('ativo'))
                    <span class="help-block">
							<strong>{{ $errors->first('ativo') }}</strong>
						</span>
                @endif
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
</form>