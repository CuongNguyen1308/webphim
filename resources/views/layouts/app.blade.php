<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
    <title>
        Admin Web phim
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

                      function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- font-awesome icons CSS -->
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- //font-awesome icons CSS-->
    <!-- side nav css file -->
    <link href="{{ asset('backend/css/SidebarNav.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <!-- //side nav css file -->
    {{-- Link css --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <!-- js-->
    <script src="{{ asset('backend/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet" />
    <!--//webfonts-->
    <!-- chart -->
    <script src="{{ asset('backend/js/Chart.js') }}"></script>
    <!-- //chart -->
    <!-- Metis Menu -->
    <script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />
    <!--//Metis Menu -->
    <style>
        #chartdiv {
            width: 100%;
            height: 295px;
        }
    </style>
    <!--pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <script src="{{ asset('backend/js/pie-chart.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#demo-pie-1').pieChart({
                barColor: '#2dde98',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8e43e7',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ffc168',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });
        });
    </script>
    <!-- //pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <!-- requried-jsfiles-for owl -->
    <link href="{{ asset('backend/css/owl.carousel.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/js/owl.carousel.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#owl-demo').owlCarousel({
                items: 3,
                lazyLoad: true,
                autoPlay: true,
                pagination: true,
                nav: true,
            });
        });
    </script>
    <!-- //requried-jsfiles-for owl -->
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <!--left-fixed -navigation-->
            @include('layouts.navbar')
        </div>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <div class="sticky-header header-section">
            <div class="header-left">

                <div class="clearfix"></div>
            </div>
            <div class="header-right">
                <!--search-box-->
                <div class="search-box">
                    <form class="input">
                        <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search"
                            id="input-31" />
                        <label class="input__label" for="input-31">
                            <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77"
                                preserveAspectRatio="none">
                                <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
                            </svg>
                        </label>
                    </form>
                </div>
                <!--//end-search-box-->
                <div class="profile_details">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img"><img src="{{ asset('backend/images/2.jpg') }}"
                                            alt="" />
                                    </span>
                                    <div class="user-name">
                                        <p>Admin Name</p>
                                        <span>Administrator</span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li>
                                    <a href="#"><i class="fa fa-cog"></i> Settings</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-user"></i> My Account</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-suitcase"></i> Profile</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="col_3">
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-dollar icon-rounded"></i>
                            <div class="stats">
                                <h5><strong>$452</strong></h5>
                                <span>Total Revenue</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong>$1019</strong></h5>
                                <span>Online Revenue</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-money user2 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong>$1012</strong></h5>
                                <span>Expenses</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong>$450</strong></h5>
                                <span>Expenditure</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widget">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong>1450</strong></h5>
                                <span>Total Users</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row-one widgettable">

                </div>

                <div class="col-md-12">
                    @yield('content')
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--footer-->
        <div class="footer">
            <p>
                &copy; 2024 Glance Design Dashboard. All Rights Reserved | Design by
                <a href="=" target="_blank">Cuong</a>
            </p>
        </div>
        <!--//footer-->
    </div>
    
    <!-- Classie -->
    <!-- for toggle left push menu script -->
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!-- //Classie -->
    <!-- //for toggle left push menu script -->
    <!--scrolling js-->
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <!--//scrolling js-->
    <!-- side nav js -->
    <script src="{{ asset('backend/js/SidebarNav.min.js') }}" type="text/javascript"></script>
    <script>
        $('.sidebar-menu').SidebarNav();
    </script>
    <!-- //side nav js -->
    <!-- for index page weekly sales java script -->
    <script src="{{ asset('backend/js/SimpleChart.js') }}"></script>
    <script>
        var graphdata1 = {
            linecolor: '#CCA300',
            title: 'Monday',
            values: [{
                    X: '6:00',
                    Y: 10.0
                },
                {
                    X: '7:00',
                    Y: 20.0
                },
                {
                    X: '8:00',
                    Y: 40.0
                },
                {
                    X: '9:00',
                    Y: 34.0
                },
                {
                    X: '10:00',
                    Y: 40.25
                },
                {
                    X: '11:00',
                    Y: 28.56
                },
                {
                    X: '12:00',
                    Y: 18.57
                },
                {
                    X: '13:00',
                    Y: 34.0
                },
                {
                    X: '14:00',
                    Y: 40.89
                },
                {
                    X: '15:00',
                    Y: 12.57
                },
                {
                    X: '16:00',
                    Y: 28.24
                },
                {
                    X: '17:00',
                    Y: 18.0
                },
                {
                    X: '18:00',
                    Y: 34.24
                },
                {
                    X: '19:00',
                    Y: 40.58
                },
                {
                    X: '20:00',
                    Y: 12.54
                },
                {
                    X: '21:00',
                    Y: 28.0
                },
                {
                    X: '22:00',
                    Y: 18.0
                },
                {
                    X: '23:00',
                    Y: 34.89
                },
                {
                    X: '0:00',
                    Y: 40.26
                },
                {
                    X: '1:00',
                    Y: 28.89
                },
                {
                    X: '2:00',
                    Y: 18.87
                },
                {
                    X: '3:00',
                    Y: 34.0
                },
                {
                    X: '4:00',
                    Y: 40.0
                },
            ],
        };
        var graphdata2 = {
            linecolor: '#00CC66',
            title: 'Tuesday',
            values: [{
                    X: '6:00',
                    Y: 100.0
                },
                {
                    X: '7:00',
                    Y: 120.0
                },
                {
                    X: '8:00',
                    Y: 140.0
                },
                {
                    X: '9:00',
                    Y: 134.0
                },
                {
                    X: '10:00',
                    Y: 140.25
                },
                {
                    X: '11:00',
                    Y: 128.56
                },
                {
                    X: '12:00',
                    Y: 118.57
                },
                {
                    X: '13:00',
                    Y: 134.0
                },
                {
                    X: '14:00',
                    Y: 140.89
                },
                {
                    X: '15:00',
                    Y: 112.57
                },
                {
                    X: '16:00',
                    Y: 128.24
                },
                {
                    X: '17:00',
                    Y: 118.0
                },
                {
                    X: '18:00',
                    Y: 134.24
                },
                {
                    X: '19:00',
                    Y: 140.58
                },
                {
                    X: '20:00',
                    Y: 112.54
                },
                {
                    X: '21:00',
                    Y: 128.0
                },
                {
                    X: '22:00',
                    Y: 118.0
                },
                {
                    X: '23:00',
                    Y: 134.89
                },
                {
                    X: '0:00',
                    Y: 140.26
                },
                {
                    X: '1:00',
                    Y: 128.89
                },
                {
                    X: '2:00',
                    Y: 118.87
                },
                {
                    X: '3:00',
                    Y: 134.0
                },
                {
                    X: '4:00',
                    Y: 180.0
                },
            ],
        };
        var graphdata3 = {
            linecolor: '#FF99CC',
            title: 'Wednesday',
            values: [{
                    X: '6:00',
                    Y: 230.0
                },
                {
                    X: '7:00',
                    Y: 210.0
                },
                {
                    X: '8:00',
                    Y: 214.0
                },
                {
                    X: '9:00',
                    Y: 234.0
                },
                {
                    X: '10:00',
                    Y: 247.25
                },
                {
                    X: '11:00',
                    Y: 218.56
                },
                {
                    X: '12:00',
                    Y: 268.57
                },
                {
                    X: '13:00',
                    Y: 274.0
                },
                {
                    X: '14:00',
                    Y: 280.89
                },
                {
                    X: '15:00',
                    Y: 242.57
                },
                {
                    X: '16:00',
                    Y: 298.24
                },
                {
                    X: '17:00',
                    Y: 208.0
                },
                {
                    X: '18:00',
                    Y: 214.24
                },
                {
                    X: '19:00',
                    Y: 214.58
                },
                {
                    X: '20:00',
                    Y: 211.54
                },
                {
                    X: '21:00',
                    Y: 248.0
                },
                {
                    X: '22:00',
                    Y: 258.0
                },
                {
                    X: '23:00',
                    Y: 234.89
                },
                {
                    X: '0:00',
                    Y: 210.26
                },
                {
                    X: '1:00',
                    Y: 248.89
                },
                {
                    X: '2:00',
                    Y: 238.87
                },
                {
                    X: '3:00',
                    Y: 264.0
                },
                {
                    X: '4:00',
                    Y: 270.0
                },
            ],
        };
        var graphdata4 = {
            linecolor: 'Random',
            title: 'Thursday',
            values: [{
                    X: '6:00',
                    Y: 300.0
                },
                {
                    X: '7:00',
                    Y: 410.98
                },
                {
                    X: '8:00',
                    Y: 310.0
                },
                {
                    X: '9:00',
                    Y: 314.0
                },
                {
                    X: '10:00',
                    Y: 310.25
                },
                {
                    X: '11:00',
                    Y: 318.56
                },
                {
                    X: '12:00',
                    Y: 318.57
                },
                {
                    X: '13:00',
                    Y: 314.0
                },
                {
                    X: '14:00',
                    Y: 310.89
                },
                {
                    X: '15:00',
                    Y: 512.57
                },
                {
                    X: '16:00',
                    Y: 318.24
                },
                {
                    X: '17:00',
                    Y: 318.0
                },
                {
                    X: '18:00',
                    Y: 314.24
                },
                {
                    X: '19:00',
                    Y: 310.58
                },
                {
                    X: '20:00',
                    Y: 312.54
                },
                {
                    X: '21:00',
                    Y: 318.0
                },
                {
                    X: '22:00',
                    Y: 318.0
                },
                {
                    X: '23:00',
                    Y: 314.89
                },
                {
                    X: '0:00',
                    Y: 310.26
                },
                {
                    X: '1:00',
                    Y: 318.89
                },
                {
                    X: '2:00',
                    Y: 518.87
                },
                {
                    X: '3:00',
                    Y: 314.0
                },
                {
                    X: '4:00',
                    Y: 310.0
                },
            ],
        };
        var Piedata = {
            linecolor: 'Random',
            title: 'Profit',
            values: [{
                    X: 'Monday',
                    Y: 50.0
                },
                {
                    X: 'Tuesday',
                    Y: 110.98
                },
                {
                    X: 'Wednesday',
                    Y: 70.0
                },
                {
                    X: 'Thursday',
                    Y: 204.0
                },
                {
                    X: 'Friday',
                    Y: 80.25
                },
                {
                    X: 'Saturday',
                    Y: 38.56
                },
                {
                    X: 'Sunday',
                    Y: 98.57
                },
            ],
        };
        $(function() {
            $('#Bargraph').SimpleChart({
                ChartType: 'Bar',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#sltchartype').on('change', function() {
                $('#Bargraph').SimpleChart('ChartType', $(this).val());
                $('#Bargraph').SimpleChart('reload', 'true');
            });
            $('#Hybridgraph').SimpleChart({
                ChartType: 'Hybrid',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Linegraph').SimpleChart({
                ChartType: 'Line',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: false,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Areagraph').SimpleChart({
                ChartType: 'Area',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Scatterredgraph').SimpleChart({
                ChartType: 'Scattered',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Piegraph').SimpleChart({
                ChartType: 'Pie',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                showpielables: true,
                data: [Piedata],
                legendsize: '250',
                legendposition: 'right',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });

            $('#Stackedbargraph').SimpleChart({
                ChartType: 'Stacked',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });

            $('#StackedHybridbargraph').SimpleChart({
                ChartType: 'StackedHybrid',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
        });
    </script>
    <!-- //for index page weekly sales java script -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <!-- //Bootstrap Core JavaScript -->
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    
    {{-- chọn phim trong thêm phim --}}
    <script>
        $('.select-movie').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ route('select-movie') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $("#show-movie").html(data);
                }
            })
        })
    </script>
    {{-- Update category ajax --}}
    <script type="text/javascript">
        $('.select-category').change(function() {
            var category = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            // alert(year);
            // alert(id_phim)
            $.ajax({
                url: "{{ url('/update-category-phim') }}",
                method: "GET",
                data: {
                    category: category,
                    id_phim: id_phim
                },
                success: function() {
                    alert("Theo đổi thể loại phim thành " + category + " thành công");
                }
            })
        })
    </script>
    {{-- update country --}}
    <script type="text/javascript">
        $('.select-country').change(function() {
            var country = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            // alert(year);
            // alert(id_phim)
            $.ajax({
                url: "{{ url('/update-country-phim') }}",
                method: "GET",
                data: {
                    country: country,
                    id_phim: id_phim
                },
                success: function() {
                    alert("Theo đổi quốc gia thành công");
                }
            })
        })
    </script>
    {{-- update hình ảnh phim --}}
    <script type="text/javascript">
        $(document).on('change', '.file-image', function() {
            var movie_id = $(this).data('movie_id');
            var files = $("#file-" + movie_id)[0].files;
            // console.log(files);
            var image = document.getElementById("file-" + movie_id).files[0];
            // console.log(image);
            var form_data = new FormData();
            form_data.append("file", document.getElementById("file-" + movie_id).files[0]);
            form_data.append("movie_id", movie_id);
            $.ajax({
                url: "{{ route('update-image-phim') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,

                contentType: false,
                cache: false,
                processData: false,

                success: function() {

                    $('#success_image').html(
                        '<span class="text-success">Cập nhật hình ảnh thành công</span>');
                    location.reload();
                }
            })
        })
    </script>
    {{-- update thuocphim --}}
    <script type="text/javascript">
        $('.select-thuocphim').change(function() {
            var thuocphim = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            $.ajax({
                url: "{{ url('/update-thuocphim-phim') }}",
                method: "GET",
                data: {
                    thuocphim: thuocphim,
                    id_phim: id_phim
                },
                success: function() {
                    alert("Theo đổi loại phim thành công");
                }
            })
        })
    </script>
    {{-- update thuocphim --}}
    <script type="text/javascript">
        $('.select-phimhot').change(function() {
            var phim_hot = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            $.ajax({
                url: "{{ url('/update-phimhot-phim') }}",
                method: "GET",
                data: {
                    phim_hot: phim_hot,
                    id_phim: id_phim
                },
                success: function() {
                    alert("Theo đổi phim hot thành công");
                }
            })
        })
    </script>
    {{-- update year --}}
    <script type="text/javascript">
        $('.select-year').change(function() {
            var year = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            $.ajax({
                url: "{{ url('/update-year-phim') }}",
                method: "GET",
                data: {
                    year: year,
                    id_phim: id_phim
                },
                success: function() {
                    alert("Theo đổi năm phim theo năm thành công");
                }
            })
        })
    </script>
    {{-- update season --}}
    <script type="text/javascript">
        $('.select-season').change(function() {
            var season = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            $.ajax({
                url: "{{ url('/update-season-phim') }}",
                method: "GET",
                data: {
                    season: season,
                    id_phim: id_phim
                },
                success: function() {
                    alert("Theo đổi season phim thành " + season + " thành công");
                }
            })
        })
    </script>
    {{-- update topviews --}}
    <script type="text/javascript">
        $('.select-topview').change(function() {
            var topview = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            if (topview == 0) {
                text = "ngày";
            } else if (topview == 1) {
                text = "tuần";
            } else {
                text = "tháng";
            }
            $.ajax({
                url: "{{ url('/update-topview') }}",
                method: "GET",
                data: {
                    topview: topview,
                    id_phim: id_phim
                },
                success: function() {
                    alert("Theo đổi topview thành " + text + " thành công");
                }
            })
        })
    </script>

    <script type="text/javascript">
        // datatable
        let tablephim = new DataTable('#tablephim');
        // chuyển chuỗi thành slug
        function ChangeToSlug() {

            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    {{-- sửa vị trí của category --}}
    <script type="text/javascript">
        $(".order_position").sortable({
            placeholder: 'ui-state-highlight',
            update: function(event, ui) {
                var array_id = [];
                $('.order_position tr').each(function() {
                    array_id.push($(this).attr('id'));
                })
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('resorting') }}",
                    method: "POST",
                    data: {
                        array_id: array_id
                    },
                    success: function(data) {
                        alert("Sắp xếp thứ tự thành công");
                    }
                })
            }
        });
    </script>
</body>

</html>
