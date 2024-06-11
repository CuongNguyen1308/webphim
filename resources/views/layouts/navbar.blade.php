<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('home') }}">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
  </nav>