@extends('layouts')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">Danh mục</a> » <span
                                        class="breadcrumb_last"
                                        aria-current="page">{{ $cate_slug->title }}</span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section>
                <div class="section-bar clearfix">
                    <h1 class="section-title"><span>{{ $cate_slug->title }}</span></h1>
                </div>

                <div class="section-bar clearfix">
                    @include('pages.include.filter')
                </div>
                <div class="halim_box">
                    @foreach ($movie as $key => $value)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{ route('movie', $value->slug) }}"
                                    title="{{ $value->title }}">
                                    <figure>
                                        @php
                                            $img_check = substr($value->image, 0, 5);
                                        @endphp
                                        @if ($img_check == 'https')
                                        <img class="lazy img-responsive" src="{{$value->image }}"
                                        alt="{{ $value->title }}" title="{{ $value->title }}">
                                        @else
                                        <img class="lazy img-responsive" src="{{ asset('uploads/movie/' . $value->image) }}"
                                        alt="{{ $value->title }}" title="{{ $value->title }}">
                                        @endif
                                        
                                    </figure>
                                    <span class="status">
                                        @if ($value->resolution == 0)
                                            HD
                                        @elseif ($value->resolution == 1)
                                            SD
                                        @elseif ($value->resolution == 2)
                                            HDCam
                                        @elseif ($value->resolution == 3)
                                            Cam
                                        @elseif ($value->resolution == 4)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                        @if ($value->episode_count > 0)
                                            {{ $value->episode_count }}/{{ $value->episodes }} |
                                        @endif
                                        @if ($value->sub == 0)
                                            Vietsub
                                        @else
                                            Thuyết minh
                                        @endif
                                    </span>
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                            <p class="entry-title">{{ $value->title }}</p>
                                            <p class="original_title">{{ $value->name_eng }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    {{-- <ul class='page-numbers'>
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="">2</a></li>
                        <li><a class="page-numbers" href="">3</a></li>
                        <li><span class="page-numbers dots">&hellip;</span></li>
                        <li><a class="page-numbers" href="">55</a></li>
                        <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
                    </ul> --}}
                    {!! $movie->links('pagination::bootstrap-4') !!}
                </div>
            </section>
        </main>
        @include('pages.include.sidebar')
    </div>
@endsection
