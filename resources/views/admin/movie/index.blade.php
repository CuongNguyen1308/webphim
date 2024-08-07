@extends('layouts.app')

@section('content')
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="video_title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="video_desc"></p>
                    <p id="video_link"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-md-12">
            <a href="{{ route('movie.create') }}" class="btn btn-primary">Thêm phim</a>
            <div class="table-responsive">
                <table class="table " id="tablephim">
                    <thead>
                        <tr>
                            <th scope="col">Action</th>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Tập phim</th>
                            <th scope="col">Số tập</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Tùy chỉnh</th>
                            <th scope="col">Hình ảnh</th>
                            {{-- <th scope="col">Tags</th> --}}
                            <th scope="col">Slug</th>
                            <th scope="col">Tên tiếng anh</th>
                            <th scope="col">Thời lượng</th>
                            <th scope="col">Độ phân giải</th>
                            <th scope="col">Phụ đề</th>
                            {{-- <th scope="col">Description</th> --}}
                            <th scope="col">Trạng thái</th>

                            <th scope="col">Lượt xem</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $value)
                            <tr>
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
                                <td>{{ $key }}</td>
                                <td>{{ $value->title }}</td>
                                <td><a href="{{ route('add-episode', $value->id) }}" class="btn btn-danger">Thêm tập</a>
                                    @foreach ($value->episode as $ep)
                                        <a class="text-light show_video" data-movie_video_id="{{ $ep->movie_id }}"
                                            data-episode_id="{{ $ep->id }}"><span
                                                class="badge badge-dark">{{ $ep->episode }}</span></a>
                                    @endforeach

                                </td>
                                <td>{{ $value->episode_count }}/{{ $value->episodes }}</td>
                                <td>
                                    @foreach ($value->movie_genre as $gen)
                                        <span class="badge badge-danger bg-danger">{{ $gen->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <label for="">Danh mục</label>
                                    {!! Form::select('category_id', $category, isset($value) ? $value->category_id : '', [
                                        'class' => 'select-category',
                                        'id' => $value->id,
                                    ]) !!}
                                    <label for="">Thuộc phim</label>
                                    {!! Form::select(
                                        'thuocphim',
                                        ['phimle' => 'Phim Lẻ', 'phimbo' => 'Phim Bộ'],
                                        isset($value) ? $value->thuocphim : '',
                                        [
                                            'class' => 'select-thuocphim',
                                            'id' => $value->id,
                                        ],
                                    ) !!}
                                    <label for="">Quốc gia</label>
                                    {!! Form::select('country_id', $country, isset($value) ? $value->country_id : '', [
                                        'class' => 'select-country',
                                        'id' => $value->id,
                                    ]) !!}
                                    <label for="">Phim hot</label>
                                    {!! Form::select('phim_hot', ['1' => 'Hot', '0' => 'Không'], isset($value) ? $value->phim_hot : '', [
                                        'class' => 'select-phimhot',
                                        'id' => $value->id,
                                    ]) !!}
                                    <label for="">Năm phim</label>
                                    {!! Form::selectYear('year', 2000, 2024, isset($value->year) ? $value->year : '', [
                                        'class' => 'select-year',
                                        'placeholder' => '-Chọn-',
                                        'id' => $value->id,
                                    ]) !!}
                                    <label for="">Phần phim</label>
                                    {!! Form::selectRange('season', 0, 20, isset($value->season) ? $value->season : '', [
                                        'class' => 'select-season',
                                        'placeholder' => '-Chọn-',
                                        'id' => $value->id,
                                    ]) !!}
                                    <label for="">Topview</label>
                                    {!! Form::select(
                                        'topview',
                                        ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'],
                                        isset($value->topview) ? $value->topview : '',
                                        ['class' => 'select-topview', 'placeholder' => '-Chọn-', 'id' => $value->id],
                                    ) !!}
                                </td>
                                <td>
                                    @php
                                        $img_check = substr($value->image, 0, 5);
                                    @endphp
                                    @if ($img_check == 'https')
                                        <img src="{{ $value->image }}" alt="" width="100px">
                                    @else
                                        <img src="{{ asset('uploads/movie/' . $value->image) }}" alt=""
                                            width="100px">
                                    @endif

                                    <input type="file" id="file-{{ $value->id }}" class="form-control"
                                        data-movie_id="{{ $value->id }}" accept="image/" id="">
                                    <span id="success_image"></span>
                                </td>
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

                                <td>
                                    @if ($value->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>


                                <td>
                                    {{ $value->count_views }}
                                </td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->updated_at }}</td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
