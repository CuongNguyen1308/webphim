@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Quản lý link phim</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($linkmovie))
                            {!! Form::open(['route' => 'link-movie.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['link-movie.update', $linkmovie->id], 'method' => 'PATCH']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($linkmovie) ? $linkmovie->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($linkmovie) ? $linkmovie->description : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'description',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('active', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'hiển thị', '0' => 'không'], isset($linkmovie) ? $linkmovie->status : '', [
                                'class' => 'form-control',
                                'id' => 'title',
                            ]) !!}
                        </div>
                        @if (!isset($linkmovie))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success mt-3']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-info mt-3']) !!}
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
