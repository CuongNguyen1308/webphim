@extends('layouts.app')

@section('content')
    <div class="modal fade" id="chitietphim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="content-title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="content-detail"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Tổng phim: {{ $resp['pagination']['totalItems'] }}
        </div>
        <div class="col-md-3">
            Phim từng trang: {{ $resp['pagination']['totalItemsPerPage'] }}
        </div>
        <div class="col-md-3">
            Chọn trang
            <form action="" method="get" onchange="submit()">
                {!! Form::selectRange('page', 1, $resp['pagination']['totalPages'], isset($_GET['page']) ? $_GET['page'] : '', [
                    'class' => 'select-page',
                ]) !!}
            </form>


        </div>
        <div class="col-md-3">
            Tổng số trang: {{ $resp['pagination']['totalPages'] }}
        </div>
    </div>
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
                                    <button type="button" data-movie_slug="{{ $value['slug'] }}"
                                        class="leech_detail btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#chitietphim">
                                        Detail movie
                                    </button>
                                    {{-- <a href="{{ route('leech-detail', $value['slug']) }}" class="btn btn-primary btn-sm">Detail movie</a> --}}

                                    @if (!$movie)
                                        <form method="POST" action="{{ route('leech-store', $value['slug']) }}">
                                            @csrf
                                            <input type="submit" class="btn btn-success btn-sm" value="Add movie ">
                                        </form>
                                    @else
                                        <a href="{{ route('leech-episodes', $value['slug']) }}"
                                            class="btn btn-info btn-sm">Episodes movie</a>
                                        <form method="POST" action="{{ route('movie.destroy', $movie->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger btn-sm"
                                                value="Delete
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
