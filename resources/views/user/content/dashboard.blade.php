@extends ('user.layout.main')
@section ('user.content')

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <div id="ItemPerBarang">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <div id="kondisiBarang">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <div id="chartJumlahAset">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src=" https://code.highcharts.com/highcharts.js">
</script>

<script>
    // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

    // Create the chart
    Highcharts.chart('chartJumlahAset', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'center',
            text: 'Aset Aktif'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total Jumlah Aset Aktif'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
        },
        series: [{
            name: 'Aset',
            colorByPoint: true,
            data: [{
                    name: 'Aset Tanah',
                    y: <?php echo $jumlahTanah; ?>,
                    color: 'blue',
                    drilldown: 'Tanah'
                },
                {
                    name: 'Aset Bangunan',
                    y: <?php echo $jumlahBangunan; ?>,
                    color: 'green',
                    drilldown: 'Bangunan'
                },
                {
                    name: 'Aset Barang',
                    y: <?php echo $jumlahItemBarang; ?>,
                    color: 'red',
                    drilldown: 'ItemBarang'
                }
            ]
        }],
        drilldown: {
            breadcrumbs: {
                position: {
                    align: 'right'
                }
            },
            series: [
                // Drilldown data
            ]
        }
    });
</script>

<script>
    // Create the chart
    Highcharts.chart('kondisiBarang', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Kondisi Barang',
            align: 'center'
        },

        accessibility: {
            announceNewData: {
                enabled: true
            },
            point: {
                valueSuffix: '%'
            }
        },

        plotOptions: {
            series: {
                borderRadius: 5,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },

        series: [{
            name: 'Kondisi',
            colorByPoint: true,
            data: [{
                    name: 'Baik',
                    y: <?php echo $barangBaik; ?>,
                    color: 'green',
                    drilldown: 'Baik'
                },
                {
                    name: 'Rusak Ringan',
                    y: <?php echo $barangRusakRingan; ?>,
                    color: 'orange',
                    drilldown: 'Rusak Ringan'
                },
                {
                    name: 'Rusak Berat',
                    y: <?php echo $barangRusakBerat; ?>,
                    color: 'red',
                    drilldown: 'Rusak Berat'
                }
            ]
        }],
        drilldown: {
            series: [{
                    name: 'Baik',
                    id: 'Baik',
                    data: [
                        [
                            'v97.0',
                            36.89
                        ],
                        // Data lainnya
                    ]
                },
                {
                    name: 'Rusak Ringan',
                    id: 'Rusak Ringan',
                    data: [
                        [
                            'v15.3',
                            0.1
                        ],
                        // Data lainnya
                    ]
                },
                {
                    name: 'Rusak Berat',
                    id: 'Rusak Berat',
                    data: [
                        [
                            'v97',
                            6.62
                        ],
                        // Data lainnya
                    ]
                },

            ]
        }
    });
</script>

<script>
    const itemData = <?php echo json_encode($itemPerBarang); ?>;

    const chartData = itemData.map(item => ({
        name: item.nama_barang,
        y: item.item_barang_count,
        drilldown: item.nama_barang
    }));

    Highcharts.chart('ItemPerBarang', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Jumlah Item Per Barang',
            align: 'center'
        },
        tooltip: {
            pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                borderRadius: 5,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>'
                }
            }
        },
        series: [{
            name: 'Browsers',
            colorByPoint: true,
            data: chartData // Use the extracted data for the chart
        }],
        drilldown: {
            series: itemData.map(item => ({
                name: item.nama_item_barang,
                id: item.nama_item_barang,
                data: [
                    [item.nama_item_barang, item.item_barang_count]
                ]
            }))
        }
    });
</script>
@endsection