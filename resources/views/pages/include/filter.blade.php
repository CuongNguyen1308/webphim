<form action="{{ route('filter-movie') }}" method="get">
    <div class="row">
        <div class="col-md-2">
            <select class="form-control" name="order">
                <option value="" hidden>Sắp xếp</option>
                <option value="date">Ngày đăng</option>
                <option value="year_release">Năm sản xuất</option>
                <option value="name_a_z">Tên phim</option>
                <option value="watch_views">Lượt xem</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control" name="genre">
                <option value="" hidden>Thể loại</option>
                @foreach ($genre as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" name="country">
                <option value="" hidden>Quốc gia</option>
                @foreach ($country as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" name="year">
                <option value="" hidden>Năm phim</option>
                @for ($year = 2000; $year <= 2024; $year++)
                    <option value="{{ $year }}">Năm {{ $year }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <input type="submit" class="btn btn-sm btn-default" value="Lọc phim">
        </div>
    </div>
</form>
