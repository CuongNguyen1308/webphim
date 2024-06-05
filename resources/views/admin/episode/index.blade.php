@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{ route('episode.create') }}" class="btn btn-primary">Thêm tập</a>
        <table class="table table-responsive" id="tablephim">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tập</th>
                    <th scope="col">Link phim</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_episode as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value->movie->title }}</td>
                        <td><img src="{{ asset('uploads/movie/' . $value->movie->image) }}" alt="" height="100px">
                        </td>
                        <td>{{ $value->episode }}</td>
                        <style>
                            .iframe_phim iframe {
                                width: 500px;
                                height: 300px;
                            }
                        </style>
                        <td>
                            <div class="iframe_phim">
                                {{ $value->linkphim }}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('episode.edit', $value->id) }}" class="btn btn-warning">Sửa</a>
                            {!! Form::open([
                                'route' => ['episode.destroy', $value->id],
                                'method' => 'DELETE',
                                'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                            ]) !!}
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
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
@endsection
