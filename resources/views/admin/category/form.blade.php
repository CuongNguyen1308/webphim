@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Quản lý danh mục</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($category))
                            {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['category.update', $category->id], 'method' => 'PATCH']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập...',
                                'id' => 'description',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('active', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'hiển thị', '0' => 'không'], isset($category) ? $category->status : '', [
                                'class' => 'form-control',
                                'id' => 'title',
                            ]) !!}
                        </div>
                        @if (!isset($category))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success mt-3']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-info mt-3']) !!}
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
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
            <tbody class="order_position">
                @foreach ($list as $key => $value)
                    <tr id="{{ $value->id }}">
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
                            <a href="{{ route('category.edit', $value->id) }}" class="btn btn-warning">Sửa</a>
                            {!! Form::open([
                                'route' => ['category.destroy', $value->id],
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
