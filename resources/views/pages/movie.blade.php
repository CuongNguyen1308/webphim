@extends('layouts')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                        href="{{ route('category', $movie->category->slug) }}">{{ $movie->category->title }}</a>
                                    » <span><a
                                            href="{{ route('country', $movie->country->slug) }}">{{ $movie->country->title }}</a>
                                        » <span class="breadcrumb_last"
                                            aria-current="page">{{ $movie->title }}</span></span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                <img class="movie-thumb" src="{{ asset('uploads/movie/' . $movie->image) }}"
                                    alt="{{ $movie->title }}">
                                @if ($movie->resolution != 5)
                                    <div class="bwa-content">
                                        @if (isset($episode_tapdau))
                                            <div class="loader"></div>
                                            @if ($movie->thuocphim == 'phimbo')
                                                <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_tapdau->episode) }}"
                                                    class="bwac-btn">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . strtolower($episode_tapdau->episode)) }}"
                                                    class="bwac-btn">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                @else
                                    <a href="#watch_trailer" style="display: block"
                                        class="watch_trailer btn btn-outline-light">Xem trailer</a>
                                @endif
                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->title }}</h1>
                                <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                            @if ($movie->resolution == 0)
                                                HD
                                            @elseif ($movie->resolution == 1)
                                                SD
                                            @elseif ($movie->resolution == 2)
                                                HDCam
                                            @elseif ($movie->resolution == 3)
                                                Cam
                                            @elseif ($movie->resolution == 4)
                                                FullHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>
                                        @if ($movie->resolution != 5)
                                            <span class="episode">
                                                @if ($movie->sub == 0)
                                                    Vietsub
                                                @else
                                                    Thuyết minh
                                                @endif
                                            </span>
                                        @endif
                                    </li>
                                    @if ($movie->season != 0)
                                        <li class="list-info-group-item"><span>Season</span> : {{ $movie->season }}</li>
                                    @endif
                                    {{-- <li class="list-info-group-item"><span>Điểm IMDb</span> : <span
                                            class="imdb">7.2</span></li> --}}
                                    <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->time }}</li>
                                    @if ($episode_current_list_count > 0)
                                        @if ($movie->thuocphim == 'phimbo')
                                            <li class="list-info-group-item"><span>Số tập</span> :
                                                {{ $episode_current_list_count }}/{{ $movie->episodes }}
                                            </li>
                                        @else
                                            <li class="list-info-group-item"><span>Tập</span> :
                                                {{ $episode_tapdau->episode }}
                                            </li>
                                        @endif
                                    @endif

                                    <li class="list-info-group-item"><span>Trạng thái</span> :
                                        @if ($episode_current_list_count == $movie->episodes)
                                            <span class="badge">Hoàn thành</span>
                                        @else
                                            <span class="badge">Đang cập nhật</span>
                                        @endif
                                    </li>
                                    <li class="list-info-group-item"><span>Thể loại</span> :
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}" rel="genre tag">{{ $gen->title }}
                                            </a>
                                        @endforeach
                                    </li>
                                    <li class="list-info-group-item"><span>Danh mục</span> :
                                        <a href="{{ route('category', $movie->category->slug) }}"
                                            rel="category tag">{{ $movie->category->title }}</a>
                                    </li>

                                    <li class="list-info-group-item"><span>Quốc gia</span> : <a
                                            href="{{ route('country', $movie->country->slug) }}"
                                            rel="tag">{{ $movie->country->title }}</a></li>
                                    @if ($episode_current_list_count > 0)
                                        <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                                            @if ($movie->thuocphim == 'phimbo')
                                                @if (isset($episode))
                                                    @foreach ($episode as $key => $ep)
                                                        <a href="{{ url('xem-phim/' . $ep->movie->slug . '/tap-' . $ep->episode) }}"
                                                            rel="tag">{{ $ep->episode }}</a>
                                                    @endforeach
                                                @endif
                                            @elseif($movie->thuocphim == 'phimle')
                                                <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . strtolower($episode_tapdau->episode)) }}"
                                                    rel="tag">{{ $episode_tapdau->episode }}</a>
                                            @endif
                                    @endif
                                    <li class="list-info-group-item">
                                        <ul class="list-inline rating" title="Average Rating">

                                            @for ($count = 1; $count <= 5; $count++)
                                                @php

                                                    if ($count <= $rating) {
                                                        $color = 'color:#ffcc00;'; //mau vang
                                                    } else {
                                                        $color = 'color:#ccc;'; //mau xam
                                                    }

                                                @endphp

                                                <li title="star_rating" id="{{ $movie->id }}-{{ $count }}"
                                                    data-index="{{ $count }}" data-movie_id="{{ $movie->id }}"
                                                    data-rating="{{ $rating }}" class="rating"
                                                    style="cursor:pointer; {{ $color }} 

                                              font-size:30px;">
                                                    &#9733;</li>
                                            @endfor

                                        </ul>
                                        <span class="total_rating">Đánh giá:
                                            {{ $rating }}/{{ $count_total }}</span>
                                    </li>



                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director"
                                            rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland"
                                            title="Cate Shortland">Cate Shortland</a></li>
                                    <li class="list-info-group-item last-item"
                                        style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;">
                                        <span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C.
                                            Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David
                                            Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin
                                            Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever
                                            Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence
                                            Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>,
                                        <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a
                                            href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a
                                            href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a
                                            href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a>
                                    </li> --}}
                                </ul>
                                <div class="movie-trailer hidden"></div>
                                <div class="like">
                                    @php
                                        $current_url = Request::url();
                                    @endphp
                                    <div class="fb-like" data-href="{{ $current_url }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                {{-- Phim <a href="https://phimhay.co/goa-phu-den-38424/">GÓA PHỤ ĐEN</a> - 2021 - Mỹ:
                                <p>Góa Phụ Đen &#8211; Black Widow 2021: Natasha Romanoff hay còn gọi là Góa phụ đen phải
                                    đối mặt với những phần đen tối của mình khi một âm mưu nguy hiểm liên quan đến quá khứ
                                    của cô nảy sinh. Bị truy đuổi bởi một thế lực sẽ không có gì có thể hạ gục cô, Natasha
                                    phải đối mặt với lịch sử là một điệp viên những mối quan hệ tan vỡ đã để lại trong cô từ
                                    lâu trước khi cô trở thành thành viên của biệt đội Avenger.</p> --}}
                                {{ $movie->description }}

                                <h5>Từ Khoá Tìm Kiếm:</h5>
                                @if ($movie->tags != null)
                                    @php
                                        $tags = [];
                                        $tags = explode(',', $movie->tags);
                                    @endphp
                                    <ul>
                                        @foreach ($tags as $key => $tag)
                                            <li><a href="{{ url('tag/' . $tag) }}">{{ $tag }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul>
                                        <li><a href="{{ url('tag/' . $movie->title) }}">{{ $movie->title }}</a></li>
                                    </ul>
                                @endif

                            </article>
                        </div>
                    </div>
                    <div class="section-bar clearfix" id="watch_trailer">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap" style="background: white">
                        <div class="video-item halim-entry-box ">

                            <article class="item-content">
                                <div class="fb-comments" data-href="{{ $current_url }}" data-width="100%"
                                    data-numposts="10"></div>
                            </article>
                        </div>
                    </div>
                    <div class="section-bar clearfix" id="watch_trailer">
                        <h2 class="section-title"><span style="color:#ffed4d">Trailer</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article class="item-content">
                                <iframe width="100%" height="350"
                                    src="https://www.youtube.com/embed/{{ $movie->trailer }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                    </div>
                    <div id="halim_related_movies-1" class="owl-carousel owl-theme related-film">
                        @foreach ($related as $key => $mov)
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}"
                                        title="{{ $mov->title }}">
                                        <figure><img class="lazy img-responsive"
                                                src="{{ asset('uploads/movie/' . $mov->image) }}"
                                                alt="{{ $mov->title }}" title="{{ $mov->title }}"></figure>
                                        <span class="status">
                                            @if ($mov->resolution == 0)
                                                HD
                                            @elseif ($mov->resolution == 1)
                                                SD
                                            @elseif ($mov->resolution == 2)
                                                HDCam
                                            @elseif ($mov->resolution == 3)
                                                Cam
                                            @elseif ($mov->resolution == 4)
                                                FullHD
                                            @else
                                                Trailer
                                            @endif
                                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                            @if ($mov->episode_count > 0)
                                                {{ $mov->episode_count }}/{{ $mov->episodes }} |
                                            @endif
                                            @if ($mov->sub == 0)
                                                Vietsub
                                            @else
                                                Thuyết minh
                                            @endif
                                        </span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $mov->title }}</p>
                                                <p class="original_title">{{ $mov->name_eng }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                            var owl = $('#halim_related_movies-1');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
                                autoplay: true,
                                autoplayTimeout: 4000,
                                autoplayHoverPause: true,
                                nav: true,
                                navText: ['<i class="hl-down-open rotate-left"></i>',
                                    '<i class="hl-down-open rotate-right"></i>'
                                ],
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2
                                    },
                                    480: {
                                        items: 3
                                    },
                                    600: {
                                        items: 4
                                    },
                                    1000: {
                                        items: 4
                                    }
                                }
                            })
                        });
                    </script>
                </div>
            </section>
        </main>
        @include('pages.include.sidebar')
    </div>
@endsection
