@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a href="/posts">Manage Posts</a><br />
                    <a href="/categories">Manage Categories</a><br />
                    <a href="/subcategories">Manage Subcategories</a><br />
                    <a href="/tags">Manage Tags</a><br />
                    <a href="/settings">Manage Settings</a><br />
                </div>
            </div>
            <div style="display: flex;">
                @foreach($settings->where('type', 'dashboard')->groupBy('name') as $name => $dash)
                    <div class="panel panel-danger" style="flex-grow: 1; @if(!$loop->last) margin-right: 15px; @endif">
                        <div class="panel-heading">{{ $name }}</div>
                        <div class="panel-body">
                            @foreach($dash as $job)
                                <a href="">{!! $job->value !!}</a><br />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="display: flex; flex-direction: column;">
                <div class="panel panel-info">
                    <div class="panel-heading">Page Visits</div>
                    <div class="panel-body" style="display: flex; justify-content: space-between;">
                        <div style="width: 45%;">
                            <h3>Today</h3>
                            <canvas width="100" height="100" id="todayVisitsChart"></canvas>
                        </div>
                        <div style="width: 45%;">
                            <h3>Lifetime</h3>
                            <canvas width="100" height="100" id="visitsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">Visitors</div>
                    <div class="panel-body">
                        <h3>Today</h3>
                        <span class="dashboard-number">{{ $totalVisitors->where('date', date('Y-m-d'))->sum('count') }}</span> Visits From <span class="dashboard-number">{{ $totalVisitors->where('date', date('Y-m-d'))->count() }}</span> Unique Visitors

                        <h3>Lifetime</h3>
                        <span class="dashboard-number">{{ $totalVisitors->sum('count') }}</span> Visits From <span class="dashboard-number">{{ $totalVisitors->unique('ip_address')->count() }}</span> Unique Visitors<br />

                        <!-- Daily Visits -->
                        <canvas id="dailyVisitsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // And for a doughnut chart
    var colors = [
        'rgb(2,117,216)',
        'rgb(92,184,92)',
        'rgb(91,192,222)',
        'rgb(240,173,78)',
        'rgb(217,83,79)',
        'rgb(2,117,216)',
        'rgb(92,184,92)',
        'rgb(91,192,222)',
        'rgb(240,173,78)',
        'rgb(217,83,79)',
        'rgb(2,117,216)',
        'rgb(92,184,92)',
        'rgb(91,192,222)',
        'rgb(240,173,78)',
        'rgb(217,83,79)'
    ];
    var ctx = $("#todayVisitsChart");
    var todayVisitsChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['{!! $todayPageVisits->pluck('url')->implode("','") !!}'],
            datasets: [{
                label: "Visits by Page (Today)",
                backgroundColor: colors,
                borderColor: colors,
                data: [{{ $todayPageVisits->pluck('count')->implode(',') }}],
            }],
        },
        options: {}
    });

    var ctx = $('#visitsChart');
    var visitsChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['{!! $pageVisits->pluck('url')->implode("','") !!}'],
            datasets: [{
                label: "Visits by Page",
                backgroundColor: colors,
                borderColor: colors,
                data: [{{ $pageVisits->pluck('count')->implode(',') }}],
            }],
        },
        options: {}
    });

    var ctx = $('#dailyVisitsChart');
    var visitsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['{!! $totalVisits->pluck('date')->implode("','") !!}'],
            datasets: [{
                label: "Visits by Day",
                backgroundColor: colors,
                borderColor: colors,
                data: [{{ $totalVisits->pluck('count')->implode(',') }}],
            }],
        },
        options: {}
    });
</script>
@endsection
