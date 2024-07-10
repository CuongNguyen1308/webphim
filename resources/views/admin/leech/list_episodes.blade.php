@extends('layouts.app')

@section('content')
    <div class="">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Số tập</th>

                            <th scope="col">Tập phim</th>
                            <th scope="col">Link embed</th>
                            <th scope="col">Link m3u8</th>

                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resp['episodes'] as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $resp['movie']['name'] }}</td>
                                <td><img src="{{ $resp['movie']['thumb_url'] }}" alt="" width="100px"></td>
                                <td>{{ $resp['movie']['episode_total'] }}</td>
                                <td>
                                    {{ $value['server_name'] }}
                                </td>
                                <td>
                                    @foreach ($value['server_data'] as $key => $server_1)
                                        <ul>
                                            <li>{{ $server_1['name'] }}
                                                <input type="text" value="{{ $server_1['link_embed'] }}">
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($value['server_data'] as $key => $server_2)
                                        <ul>
                                            <li>{{ $server_2['name'] }}
                                                <input type="text" value="{{ $server_2['link_m3u8'] }}">
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('leech-episodes-store', $resp['movie']['slug']) }}"
                                        method="post">
                                        @csrf
                                        <input type="submit" value="Thêm tập phim" class="btn btn-info btn-sm">
                                    </form>
                                    @if (isset($movie_episode))
                                        <form action="{{ route('leech-destroy', $movie->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Xóa tập phim" class="btn btn-warning btn-sm">
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
