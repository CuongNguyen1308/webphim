<form action="{{ route('filter-movie') }}" method="get">
    <style>
        .select_option{
            background: #12171b ;
            color: white;
            border: none;
            };
    </style>
    <div class="row">
        <div class="col-md-2">
            <select class="form-control select_option" name="order">
                <option value="" hidden>Sắp xếp</option>
                <option value="update_at">Ngày đăng</option>
                <option value="year_release">Năm sản xuất</option>
                <option value="name_a_z">Tên phim</option>
                <option value="watch_views">Lượt xem</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select_option" name="genre">
                <option value="" hidden>Thể loại</option>
                @foreach ($genre as $key => $value)
                    <option {{ isset($_GET['genre']) && $_GET['genre'] == $value->id ? "selected" : ""}} value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select_option" name="country">
                <option value="" hidden>Quốc gia</option>
                @foreach ($country as $key => $value)
                    <option {{ isset($_GET['country']) && $_GET['country'] == $value->id ? "selected" : ""}} value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control select_option" name="year">
                <option value="" hidden>Năm phim</option>
                @for ($year = 2000; $year <= 2024; $year++)
                    <option {{ isset($_GET['year']) && $_GET['year'] == $year ? "selected" : ""}} value="{{ $year }}">Năm {{ $year }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control select_option" value="Lọc phim">
        </div>
    </div>
</form>
