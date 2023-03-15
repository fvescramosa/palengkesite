@extends('layouts.seller')

@section('content')
    <div class="profile">
        <div class="profile-wrapper">
            <canvas id="myChart" height="100px"></canvas>
            <script>


                var labels =   @json($labels) ;
                var sales =  @json($data) ;


                const data = {
                    labels: labels,

                    datasets: [{
                        fill: false,
                        label: '{{ ucwords( $product->product_name ) }}',
                        // backgroundColor: ['rgb(255, 99, 132)', 'rgb(255, 99, 111)'],
                        borderColor: 'rgb(255, 99, 132)',
                        data: sales,
                    }]
                };

                const config = {
                    type: 'line',
                    data: data,

                    options: {}
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            </script>


        </div>
    </div>
@endsection
