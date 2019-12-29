@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <canvas id="myChart" width="800" height="450" class="col-md-12"></canvas>
        <div class="col-md col-md-6 pb-3 py-3">
            <div class="card h-100">
                <div class="row h-100 no-gutters">
                    <div class="col-6 p-3">
                        <h5>Suhu</h5>
                        <h2 id="valuetemp"></h2>
                    </div>
                    <div class="col bg-info text-white d-flex">
                        <h1 class="mx-auto align-self-center">
                            <i class="fas fa-2x fa-temperature-low"></i>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: [],
            datasets: [{
                label: 'Temperature',
                data: [],
                borderWidth: 2,
                borderColor: "#3e95cd",
                fill: false
            }]
            },
            options: {
            scales: {
                xAxes: [],
                yAxes: [{
                ticks: {
                    beginAtZero:true
                }
                }]
            }
            }
        });
        
        var updateChart = function () { 
            $.ajax({
            url: "{{ route('data') }}",
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                myChart.data.labels = data.labels;
                myChart.data.datasets[0].data = data.data;
                myChart.update();
                console.log(data.data.slice(-1)[0]);
                $("#valuetemp").text(data.data.slice(-1)[0] + " Celcius");
                // response.forEach(function (data) {  
                //     temp.push(data.temperature);
                //     time.push(data.created_at);
                // });
                // myChart.data.labels = time;
                // myChart.data.datasets[0].data = temp;
                // myChart.update();
            },
            error: function(data){
                console.log(data);
            }
        });
        }
        updateChart();
        setInterval(() => {
            updateChart();
        }, 15000);
    </script>
@endpush
