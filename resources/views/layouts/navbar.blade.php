<aside class="sidebar-left">
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1>
                <a class="navbar-brand" href="{{ route('homepage') }}"><img
                        src="{{ asset('uploads/logo/' . $info->logo) }}" alt=""></a>
            </h1>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
                <li class="header">Quản lý webphim</li>
                <li class="treeview">
                    <a href="{{ url('/home') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                @php
                    $segment = Request::segment(1);
                @endphp
                <li class="treeview ">
                    <a href="{{ route('info.create') }}">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        <span>Thông tin website</span>

                    </a>
                </li>
                <li class="treeview {{ $segment == 'category' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        <span>Danh mục</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('category.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                danh mục</a>
                        </li>
                        <li>
                            <a href="{{ route('category.index') }}"><i class="fa fa-angle-right"></i> Danh
                                sách danh mục</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'genre' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        <span>Thể loại</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('genre.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                thể loại</a>
                        </li>
                        <li>
                            <a href="{{ route('genre.index') }}"><i class="fa fa-angle-right"></i> Danh
                                sách thể loại</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'country' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        <span>Quốc gia</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('country.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                quốc gia</a>
                        </li>
                        <li>
                            <a href="{{ route('country.index') }}"><i class="fa fa-angle-right"></i> Danh
                                sách quốc gia</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'movie' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-film" aria-hidden="true"></i>
                        <span>Phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('movie.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                phim</a>
                        </li>
                        <li>
                            <a href="{{ route('movie.index') }}"><i class="fa fa-angle-right"></i> Danh
                                sách phim</a>
                        </li>
                        <li>
                            <a href="{{ route('sort_movie') }}"><i class="fa fa-angle-right"></i> Sắp xếp phim</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'episode' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-film" aria-hidden="true"></i>
                        <span>Tập phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('episode.create') }}"><i class="fa fa-angle-right"></i> Thêm tập
                                phim</a>
                        </li>
                        <li>
                            <a href="{{ route('episode.index') }}"><i class="fa fa-angle-right"></i> Danh
                                sách tập phim</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $segment == 'link-movie' ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-film" aria-hidden="true"></i>
                        <span>Link phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('link-movie.create') }}"><i class="fa fa-angle-right"></i> Thêm link
                                phim</a>
                        </li>
                        <li>
                            <a href="{{ route('link-movie.index') }}"><i class="fa fa-angle-right"></i> Danh
                                sách link</a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-video-o" aria-hidden="true"></i>
                        <span>Tập phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('episode.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                tập phim</a>
                        </li>
                        <li>
                            <a href="{{ route('episode.index') }}"><i class="fa fa-angle-right"></i> Danh
                                sách tập phim</a>
                        </li>
                    </ul>
                </li> --}}

        </div>
        <!-- /.navbar-collapse -->
    </nav>
</aside>
{{-- <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('info.create') }}">Thông tin website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('category.create') }}">Danh mục phim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('genre.create') }}">Thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('country.create') }}">Quốc gia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('movie.index') }}">Phim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('episode.index') }}">Tập phim</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav> --}}
