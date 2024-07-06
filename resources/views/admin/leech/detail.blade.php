@extends('layouts.app')

@section('content')
    <div class="">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">_id</th>
                            <th scope="col">name</th>
                            <th scope="col">category</th>
                            <th scope="col">country</th>
                            <th scope="col">slug</th>
                            <th scope="col">origin_name</th>
                            <th scope="col">type</th>
                            <th scope="col">status</th>
                            <th scope="col">poster_url</th>
                            <th scope="col">thumb_url</th>
                            <th scope="col">time</th>
                            <th scope="col">episode_current</th>
                            <th scope="col">episode_total</th>
                            <th scope="col">lang</th>
                            <th scope="col">year</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resp_movie as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value['_id'] }}</td>
                                <td>{{ $value['name'] }}</td>
                                <td>
                                    @foreach ($value['category'] as $category)
                                        <span class="badge badge-info">{{ $category['name'] }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($value['country'] as $country)
                                        <span class="badge badge-info">{{ $country['name'] }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $value['slug'] }}</td>
                                <td>{{ $value['origin_name'] }}</td>
                                <td>{{ $value['type'] }}</td>
                                <td>{{ $value['status'] }}</td>
                                <td>
                                    <img src="{{ $value['poster_url'] }}" alt="" width="100px">
                                </td>
                                <td>
                                    <img src="{{ $value['thumb_url'] }}" alt="" width="100px">
                                </td>
                                <td>{{ $value['time'] }}</td>
                                <td>{{ $value['episode_current'] }}</td>
                                <td>{{ $value['episode_total'] }}</td>
                                <td>{{ $value['lang'] }}</td>
                                <td>{{ $value['year'] }}</td>
                                <td>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
