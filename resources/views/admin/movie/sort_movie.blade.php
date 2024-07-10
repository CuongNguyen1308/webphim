@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Sắp xếp vị trí</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <style>
                            .ui-state-highlight {
                                height: 1.5em;
                                line-height: 1.2em;
                            }
                        </style>
                        <nav class="navbar navbar-inverse">
                            <div class="container-fluid">
                                <ul class="nav navbar-nav cate_position" id="sortable_nav">
                                    @foreach ($category_home as $key => $value)
                                        <li id="{{ $value->id }}" class="active ui-state-default"><a
                                                title="{{ $value->title }}"
                                                href="{{ route('category', $value->slug) }}">{{ $value->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </nav>
                        @foreach ($category_home as $key => $cate_home)
                            <section id="halim-advanced-widget-2">
                                <div class="section-heading">
                                    <a href="{{ route('category', $cate_home->slug) }}" title="{{ $cate_home->title }}">
                                        <span class="h-text">{{ $cate_home->title }}</span>
                                    </a>
                                </div>
                                <div id="halim-advanced-widget-2-ajax-box" class="halim_box mov_position sortable_movie">
                                    @foreach ($cate_home->movie->sortBy('position')->take(12) as $key => $mov)
                                        <article class="col-md-2 col-sm-2 col-xs-3 thumb grid-item post-37606"
                                            id="{{ $mov->id }}">
                                            <div class="halim-item">
                                                <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                                                    <figure>
                                                        @php
                                                            $img_check = substr($mov->image, 0, 5);
                                                        @endphp
                                                        @if ($img_check == 'https')
                                                            <<img class="lazy img-responsive"
                                                                src="{{$mov->image }}"
                                                                alt="{{ $mov->title }}" title="{{ $mov->title }}">
                                                            @else
                                                                <img class="lazy img-responsive"
                                                                    src="{{ asset('uploads/movie/' . $mov->image) }}"
                                                                    alt="{{ $mov->title }}" title="{{ $mov->title }}">
                                                        @endif

                                                    </figure>
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
                                                    </span>
                                                    @if ($mov->episode_count > 0)
                                                        @if ($mov->thuocphim == 'phimbo')
                                                            <span class="episode"><i class="fa fa-play"
                                                                    aria-hidden="true"></i>
                                                                Tập {{ $mov->episode_count }}/{{ $mov->episodes }}
                                                            </span>
                                                        @else
                                                            <span class="episode"><i class="fa fa-play"
                                                                    aria-hidden="true"></i>
                                                                Full
                                                            </span>
                                                        @endif
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
                            </section>
                            <div class="clearfix"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
