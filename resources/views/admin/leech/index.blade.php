@extends('layouts.app')

@section('content')
    <div class="">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table " id="tablephim">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Tên tiếng anh</th>
                            <th scope="col">Hình ảnh poster</th>
                            <th scope="col">Hình ảnh thumb</th>
                            <th scope="col">Năm</th>

                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resp['items'] as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value['name'] }}</td>
                                <td>{{ $value['slug'] }}</td>
                                <td>{{ $value['origin_name'] }}</td>
                                <td>
                                    <img src="{{ $value['poster_url'] }}" alt="" width="100px">
                                </td>
                                <td>
                                    <img src="{{ $value['thumb_url'] }}" alt="" width="100px">
                                </td>
                                <td>{{ $value['year'] }}</td>
                                <td>
                                    @php
                                        $movie = \App\Models\Movie::where('slug', $value['slug'])->first();
                                    @endphp

                                    <a href="{{ route('leech-detail', $value['slug']) }}" class="btn btn-primary btn-sm">Detail movie</a>

                                    @if (!$movie)
                                        <form method="POST" action="{{ route('leech-store', $value['slug']) }}">
                                            @csrf
                                            <input type="submit" class="btn btn-success btn-sm" value="Add movie ">
                                        </form>
                                    @else
                                    <a href="{{ route('leech-episodes', $value['slug']) }}" class="btn btn-info btn-sm">Episodes movie</a>
                                        <form method="POST" action="{{ route('movie.destroy', $movie->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete
                                            movie">
                                        </form>
                                        
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
