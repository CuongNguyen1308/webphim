@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('movie.index') }}" class="btn btn-warning">Liệt kê phim</a>
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Quản lý phim</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!isset($movie))
                            {!! Form::open(['route' => 'movie.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open([
                                'route' => ['movie.update', $movie->id],
                                'method' => 'PATCH',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên phim', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name_eng', 'Tên tiếng anh', []) !!}
                            {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'name_eng',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('trailer', 'Trailer', []) !!}
                            {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'trailer',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('time', 'Thời lượng phim', []) !!}
                            {!! Form::text('time', isset($movie) ? $movie->time : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'time',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('resolution', 'Chất lượng', []) !!}
                            {!! Form::select(
                                'resolution',
                                ['0' => 'HD', '1' => 'SD', '2' => 'HDCam', '3' => 'Cam', '4' => 'Full HD', '5' => 'Trailer'],
                                isset($movie) ? $movie->resolution : '',
                                [
                                    'class' => 'form-control',
                                    'id' => 'resolution',
                                ],
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sub', 'Phụ đề', []) !!}
                            {!! Form::select('sub', ['1' => 'Thuyết minh', '0' => 'Vietsub'], isset($movie) ? $movie->sub : '', [
                                'class' => 'form-control',
                                'id' => 'sub',
                            ]) !!}
                        </div>



                        <div class="form-group">
                            {!! Form::label('tags', 'Tags', []) !!}
                            {!! Form::text('tags', isset($movie) ? $movie->tags : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'tags',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('active', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'hiển thị', '0' => 'không'], isset($movie) ? $movie->status : '', [
                                'class' => 'form-control',
                                'id' => 'status',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('episodes', 'Số tập', []) !!}
                            {!! Form::text('episodes', isset($movie) ? $movie->episodes : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'episodes',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('thuocphim', 'Thuộc phim', []) !!}
                            {!! Form::select(
                                'thuocphim',
                                ['phimle' => 'Phim Lẻ', 'phimbo' => 'Phim Bộ'],
                                isset($movie) ? $movie->thuocphim : '',
                                [
                                    'class' => 'form-control',
                                    'id' => 'thuocphim',
                                ],
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category', 'Danh mục phim', []) !!} <br>
                            {{-- {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', [
                                'class' => 'form-control',
                                'id' => 'category',
                            ]) !!} --}}
                            @foreach ($list_category as $key => $value)
                                @if (isset($movie))
                                    {!! Form::checkbox(
                                        'category[]',
                                        $value->id,
                                        isset($movie_category) && $movie_category->contains($value->id) ? true : false,
                                    ) !!}
                                @else
                                    {!! Form::checkbox('category[]', $value->id) !!}
                                @endif

                                {!! Form::label('category', $value->title) !!}
                            @endforeach
                        </div>
                        <div class="form-group">
                            {!! Form::label('genre', 'Thể loại', []) !!} <br>
                            {{-- {!! Form::select('genre_id', $genre,isset($movie) ? $movie->genre_id : "", [
                                'class' => 'form-control',
                                'id' => 'genre',
                            ]) !!} --}}
                            @foreach ($list_genre as $key => $value)
                                @if (isset($movie))
                                    {!! Form::checkbox(
                                        'genre[]',
                                        $value->id,
                                        isset($movie_genre) && $movie_genre->contains($value->id) ? true : false,
                                    ) !!}
                                @else
                                    {!! Form::checkbox('genre[]', $value->id) !!}
                                @endif

                                {!! Form::label('genre', $value->title) !!}
                            @endforeach
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', [
                                'class' => 'form-control',
                                'id' => 'country',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('hot', 'Hot', []) !!}
                            {!! Form::select('phim_hot', ['1' => 'Có', '0' => 'Không'], isset($movie) ? $movie->phim_hot : '', [
                                'class' => 'form-control',
                                'id' => 'country',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Hình ảnh', []) !!}
                            {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}
                            @if (isset($movie))
                                <img src="{{ asset('uploads/movie/' . $movie->image) }}" alt="" width="20%">
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        @if (!isset($movie))
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
