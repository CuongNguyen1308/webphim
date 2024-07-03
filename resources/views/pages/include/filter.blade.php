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
                <option {{ isset($_GET['order']) && $_GET['order'] == 'created_at' ? "selected" : ""}} value="created_at">Ngày đăng</option>
                <option {{ isset($_GET['order']) && $_GET['order'] == 'year' ? "selected" : ""}} value="year">Năm sản xuất</option>
                <option {{ isset($_GET['order']) && $_GET['order'] == 'title' ? "selected" : ""}} value="title">Tên phim</option>
                <option {{ isset($_GET['order']) && $_GET['order'] == 'topview' ? "selected" : ""}} value="topview">Lượt xem</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select_option" name="genre">
                <option value="" hidden>Thể loại</option>
                @foreach ($genre_home as $key => $value)
                    <option {{ isset($_GET['genre']) && $_GET['genre'] == $value->id ? "selected" : ""}} value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select_option" name="country">
                <option value="" hidden>Quốc gia</option>
                @foreach ($country_home as $key => $value)
                    <option {{ isset($_GET['country']) && $_GET['country'] == $value->id ? "selected" : ""}} value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control select_option" name="year">
                <option value="" hidden>Năm phim</option>
                @for ($year = 2000; $year <= 2025; $year++)
                    <option {{ isset($_GET['year']) && $_GET['year'] == $year ? "selected" : ""}} value="{{ $year }}">Năm {{ $year }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control select_option" value="Lọc phim">
        </div>
    </div>
</form>
