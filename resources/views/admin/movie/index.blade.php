@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('movie.create') }}" class="btn btn-primary">Thêm phim</a>
        {{-- <div class="table-responsive"></div> --}}
        <table class="table " id="tablephim">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Số tập</th>
                    {{-- <th scope="col">Tags</th> --}}
                    <th scope="col">Slug</th>
                    <th scope="col">Tên tiếng anh</th>
                    <th scope="col">Thời lượng</th>
                    <th scope="col">Độ phân giải</th>
                    <th scope="col">Phụ đề</th>
                    {{-- <th scope="col">Description</th> --}}
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Thuộc phim</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Quốc gia</th>
                    <th scope="col">PHIMHOT</th>
                    <th scope="col">Năm phim</th>
                    <th scope="col">Phần phim</th>
                    <th scope="col">Topview</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Updated_at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value->title }}</td>
                        <td><a href="{{ route('add-episode',$value->id) }}" class="btn btn-danger">Thêm tập</a></td>
                        <td>{{ $value->episode_count }}/{{ $value->episodes }}</td>
                        {{-- <td>{{ $value->tags }}</td> --}}
                        <td>{{ $value->slug }}</td>
                        <td>{{ $value->name_eng }}</td>
                        <td>{{ $value->time }}</td>
                        <td>
                            @if ($value->resolution == 0)
                                HD
                            @elseif ($value->resolution == 1)
                                SD
                            @elseif ($value->resolution == 2)
                                HDCam
                            @elseif ($value->resolution == 3)
                                Cam
                            @elseif ($value->resolution == 4)
                                FullHD
                            @else
                                Trailer
                            @endif
                        </td>
                        <td>
                            @if ($value->sub == 0)
                                Vietsub
                            @else
                                Thuyết minh
                            @endif
                        </td>
                        {{-- <td>{{ $value->description }}</td> --}}
                        <td><img src="{{ asset('uploads/movie/' . $value->image) }}" alt="" width="50px"></td>
                        <td>
                            @if ($value->status)
                                Hiển thị
                            @else
                                Không hiển thị
                            @endif
                        </td>
                        <td>{{ $value->category->title }}</td>

                        <td>
                            @if ($value->thuocphim == 'phimle')
                                Phim lẻ
                            @else
                                Phim bộ
                            @endif
                        </td>

                        <td>
                            @foreach ($value->movie_genre as $gen)
                                <span class="badge badge-danger bg-danger">{{ $gen->title }}</span>
                            @endforeach
                        </td>
                        <td>{{ $value->country->title }}</td>
                        <td>
                            @if ($value->phim_hot)
                                HOT
                            @else
                                KHÔNG
                            @endif
                        </td>
                        <td>
                            {!! Form::selectYear('year', 2000, 2024, isset($value->year) ? $value->year : '', [
                                'class' => 'select-year',
                                'placeholder' => '-Chọn-',
                                'id' => $value->id,
                            ]) !!}
                        </td>
                        <td>
                            {!! Form::selectRange('season', 0, 20, isset($value->season) ? $value->season : '', [
                                'class' => 'select-season',
                                'placeholder' => '-Chọn-',
                                'id' => $value->id,
                            ]) !!}
                        </td>
                        <td>
                            {!! Form::select(
                                'topview',
                                ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'],
                                isset($value->topview) ? $value->topview : '',
                                ['class' => 'select-topview', 'placeholder' => '-Chọn-','id' => $value->id ],
                            ) !!}
                        </td>
                        <td>{{ $value->created_at }}</td>
                        <td>{{ $value->updated_at }}</td>

                        <td>
                            <a href="{{ route('movie.edit', $value->id) }}" class="btn btn-warning">Sửa</a>
                            {!! Form::open([
                                'route' => ['movie.destroy', $value->id],
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
