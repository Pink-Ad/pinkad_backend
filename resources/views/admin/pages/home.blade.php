@extends('.admin.layouts.default')

@section('content')

<header class="page-header page-header-left-inline-breadcrumb">
    <h2 class="font-weight-bold text-6">Home</h2>
    <div class="right-wrapper">
        <ol class="breadcrumbs">
            <li><span>Dashboard</span></li>
            <li><span>Home</span></li>
        </ol>
    </div>
</header>

<!-- start: page -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
                <section class="card card-featured-left card-featured-primary mb-3">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="bx bx-user-pin"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Total Visitors</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $visitor }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="{{ route('visitor-management.index') }}">(view visitors)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="card card-featured-left card-featured-secondary mb-3">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-secondary">
                                    <i class="bx bx-male-sign"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Total Sellers</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $seller }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="{{ route('seller-management.index') }}">(VIEW SELLERS)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="card card-featured-left card-featured-success mb-3">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-success">
                                    <i class="bx bx-download"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Monthly Downloads</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $monthly_user_count }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="#">(VIEW REPORT)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                </div>

                <h2 class="card-title">Bars Chart</h2>
                <p class="card-subtitle">Default Bar Chart.</p>
            </header>
            <div class="card-body">

                <!-- Flot: Bars -->
                <div class="chart chart-md" id="flotBars" style="padding: 0px; position: relative;"><canvas class="flot-base" width="429" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 429px; height: 350px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 33px; text-align: center;">Jan</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 66px; text-align: center;">Feb</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 98px; text-align: center;">Mar</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 132px; text-align: center;">Apr</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 163px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 197px; text-align: center;">Jun</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 232px; text-align: center;">Jul</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 262px; text-align: center;">Aug</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 295px; text-align: center;">Sep</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 329px; text-align: center;">Oct</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 361px; text-align: center;">Nov</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 327px; left: 393px; text-align: center;">Dec</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 301px; left: 8px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 241px; left: 4px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 181px; left: 2px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 120px; left: 1px; text-align: right;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 60px; left: 1px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">50</div></div></div><canvas class="flot-overlay" width="429" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 429px; height: 350px;"></canvas></div>
                <script type="text/javascript">

                    var flotBarsData = [
                        ["Jan", 28],
                        ["Feb", 42],
                        ["Mar", 25],
                        ["Apr", 23],
                        ["May", 37],
                        ["Jun", 33],
                        ["Jul", 18],
                        ["Aug", 14],
                        ["Sep", 18],
                        ["Oct", 15],
                        ["Nov", 4],
                        ["Dec", 7]
                    ];

                    // See: js/examples/examples.charts.js for more settings.

                </script>

            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                </div>

                <h2 class="card-title">Pie Chart</h2>
                <p class="card-subtitle">Default Pie Chart.</p>
            </header>
            <div class="card-body">

                <!-- Flot: Pie -->
                <div class="chart chart-md" id="flotPie" style="padding: 0px; position: relative;"><canvas class="flot-base" width="429" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 429px; height: 350px;"></canvas><canvas class="flot-overlay" width="429" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 429px; height: 350px;"></canvas><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 202px; left: 352.719px;"><div style="font-size:x-small;text-align:center;padding:2px;color:#0088cc;">Series 1<br>60%</div></span><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 249px; left: 59.4453px;"><div style="font-size:x-small;text-align:center;padding:2px;color:#2baab1;">Series 2<br>10%</div></span><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 125px; left: 29.375px;"><div style="font-size:x-small;text-align:center;padding:2px;color:#734ba9;">Series 3<br>15%</div></span><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 3px; left: 118.18px;"><div style="font-size:x-small;text-align:center;padding:2px;color:#E36159;">Series 4<br>15%</div></span></div>
                <script type="text/javascript">

                    var flotPieData = [{
                        label: "Series 1",
                        data: [
                            [1, 60]
                        ],
                        color: '#0088cc'
                    }, {
                        label: "Series 2",
                        data: [
                            [1, 10]
                        ],
                        color: '#2baab1'
                    }, {
                        label: "Series 3",
                        data: [
                            [1, 15]
                        ],
                        color: '#734ba9'
                    }, {
                        label: "Series 4",
                        data: [
                            [1, 15]
                        ],
                        color: '#E36159'
                    }];

                    // See: js/examples/examples.charts.js for more settings.

                </script>

            </div>
        </section>
    </div>
</div>
@stop
