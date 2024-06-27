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
                    <th scope="col">Server</th>
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
                        <td>{{ $value->linkserver }}</td>
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
    
@endsection
