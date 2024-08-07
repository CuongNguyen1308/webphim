@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table" id="tablephim">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->slug }}</td>
                        <td>{{ $value->description }}</td>
                        <td>
                            @if ($value->status)
                                Hiển thị
                            @else
                                Không hiển thị
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('genre.edit',$value->id) }}" class="btn btn-warning">Sửa</a>
                            {!! Form::open(['route' => ['genre.destroy',$value->id], 'method' => 'DELETE','onsubmit'=>'return confirm("Bạn có muốn xóa không?")']) !!}
                            {!! Form::submit("Xóa", ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        

    </div>
@endsection
