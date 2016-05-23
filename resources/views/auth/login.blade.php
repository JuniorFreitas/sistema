@extends('sistema.layoutSistema')
@section('content')
    <style>
        body {
            background: #1b6d85;
        }
    </style>
    <div class="container">
        <div class="row" style="margin-top: 15%;">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="formAjax" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">CPF</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="cpf" id="cpf"
                                           value="{{ old('cpf') }}">

                                    @if ($errors->has('cpf'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Senha</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Lembrar-me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Login
                                    </button>
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu sua senha?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $("#cpf").mask("999.999.999-99", {placeholder: "_"});
        })
    </script>
@endsection