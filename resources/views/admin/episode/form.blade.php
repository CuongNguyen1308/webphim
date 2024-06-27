@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('episode.index') }}" class="btn btn-primary">Danh sách tập </a>

        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Quản lý tập phim</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!isset($episode))
                            {!! Form::open(['route' => 'episode.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['episode.update', $episode->id], 'method' => 'PATCH']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('movie_id', 'Chọn phim', []) !!}
                            {!! Form::select(
                                'movie_id',
                                ['0' => '---Chọn phim---', 'Phim' => $list_movie],
                                isset($episode) ? $episode->movie_id : '',
                                [
                                    'class' => 'form-control select-movie',
                                    'id' => 'title',
                                ],
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('linkphim', 'Link phim', []) !!}
                            {!! Form::text('linkphim', isset($episode) ? $episode->linkphim : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'linkphim',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('linkserver', 'Link server', []) !!}
                            {!! Form::select('linkserver', $linkserver, isset($episode) ? $episode->linkserver : '', [
                                'class' => 'form-control',
                                'id' => 'linkserver',
                            ]) !!}
                        </div>
                        @if (isset($episode))
                            <div class="form-group">
                                {!! Form::label('episode', 'Tập phim', []) !!}
                                {!! Form::text('episode', isset($episode) ? $episode->episode : '', [
                                    'class' => 'form-control',
                                    // 'readonly',
                                ]) !!}
                            </div>
                        @else
                            <div class="form-group">
                                {!! Form::label('episode', 'Tập phim', []) !!}
                                <select name="episode" class="form-control" id="show-movie" id="">
                                    
                                </select>
                            </div>
                        @endif

                        @if (!isset($episode))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success mt-3']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-warning mt-3']) !!}
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
