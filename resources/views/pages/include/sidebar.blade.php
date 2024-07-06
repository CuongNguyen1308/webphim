<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim hot</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach ($phimhot_sidebar as $key => $hot_sidebar)
                        <div class="item post">
                            <a href="{{ route('movie', $hot_sidebar->slug) }}" title="{{ $hot_sidebar->title }}">
                                <div class="item-link">
                                    @php
                                        $img_check = substr($hot_sidebar->image, 0, 5);
                                    @endphp
                                    @if ($img_check == 'https')
                                        <img src="{{ $hot_sidebar->image }}" class="lazy post-thumb"
                                            alt="{{ $hot_sidebar->title }}" title="{{ $hot_sidebar->title }}" />
                                    @else
                                        <img src="{{ asset('uploads/movie/' . $hot_sidebar->image) }}"
                                            class="lazy post-thumb" alt="{{ $hot_sidebar->title }}"
                                            title="{{ $hot_sidebar->title }}" />
                                    @endif

                                    <span class="is_trailer">
                                        @if ($hot_sidebar->resolution == 0)
                                            HD
                                        @elseif ($hot_sidebar->resolution == 1)
                                            SD
                                        @elseif ($hot_sidebar->resolution == 2)
                                            HDCam
                                        @elseif ($hot_sidebar->resolution == 3)
                                            Cam
                                        @elseif ($hot_sidebar->resolution == 4)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $hot_sidebar->title }}</p>
                                {{-- hiển thị sao --}}

                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">Năm: {{ $hot_sidebar->year }}
                            </div>
                            <div class="viewsCount" style="color: #9d9d9d;">{{ $hot_sidebar->count_views }} lượt xem
                            </div>

                            <ul class="list-inline rating" title="Average Rating">
                                @for ($count = 1; $count <= 5; $count++)
                                    <li title="star_rating" class="star"
                                        style="color:#ffcc00; font-size:15px; padding:0;">
                                        &#9733;</li>
                                @endfor
                            </ul>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim sắp chiếu</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach ($phimhot_trailer as $key => $hot_trailer)
                        <div class="item post">
                            <a href="{{ route('movie', $hot_trailer->slug) }}" title="{{ $hot_trailer->title }}">
                                <div class="item-link">
                                    @php
                                        $img_check = substr($hot_trailer->image, 0, 5);
                                    @endphp
                                    @if ($img_check == 'https')
                                        <img src="{{$hot_trailer->image }}"
                                            class="lazy post-thumb" alt="{{ $hot_trailer->title }}"
                                            title="{{ $hot_trailer->title }}" />
                                    @else
                                        <img src="{{ asset('uploads/movie/' . $hot_trailer->image) }}"
                                            class="lazy post-thumb" alt="{{ $hot_trailer->title }}"
                                            title="{{ $hot_trailer->title }}" />
                                    @endif

                                    <span class="is_trailer">
                                        @if ($hot_trailer->resolution == 0)
                                            HD
                                        @elseif ($hot_trailer->resolution == 1)
                                            SD
                                        @elseif ($hot_trailer->resolution == 2)
                                            HDCam
                                        @elseif ($hot_trailer->resolution == 3)
                                            Cam
                                        @elseif ($hot_trailer->resolution == 4)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $hot_trailer->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">Năm: {{ $hot_trailer->year }}
                            </div>
                            <div class="viewsCount" style="color: #9d9d9d;">{{ $hot_trailer->count_views }} lượt xem
                            </div>

                            <ul class="list-inline rating" title="Average Rating">
                                @for ($count = 1; $count <= 5; $count++)
                                    <li title="star_rating" class="star"
                                        style="color:#ffcc00; font-size:15px; padding:0;">
                                        &#9733;</li>
                                @endfor
                            </ul>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>
            </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab"
                    aria-controls="pills-home" aria-selected="true">Ngày</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan"
                    role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang"
                    role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div id="halim-ajax-popular-post-default" class="popular-post">
                <span id="show_data_default"></span>
            </div>
            <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-home-tab">
                <div id="halim-ajax-popular-post" class="popular-post">
                    {{-- <div class="item post-37176">
                        <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                            <div class="item-link">
                                <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798"
                                    class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                    title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                <span class="is_trailer">Trailer</span>
                            </div>
                            <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                        <div style="float: left;">
                            <span class="user-rate-image post-large-rate stars-large-vang"
                                style="display: block;/* width: 100%; */">
                                <span style="width: 0%"></span>
                            </span>
                        </div>
                    </div> --}}
                    <span id="show_data"></span>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div id="halim-ajax-popular-post" class="popular-post">
                    <span id="show1"></span>
                </div>
            </div>
            <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div id="halim-ajax-popular-post" class="popular-post">
                    <span id="show2"></span>
                </div>
            </div> --}}
        </div>

        <div class="clearfix"></div>
    </div>

</aside>
