@extends('layouts.seller')

@section('content')
    <div class="profile" style="padding: 60px;">
        <div class="profile-wrapper" >


            <form action="" class="form-group col-5" method="GET" id="sale-filter">
                <label for="">Filter by Month</label>
                <select  class="form-control" id="productOption" name="productOption" placeholder="Order By"  >
                   @for($i=1; $i<=12; $i++)

                       @php
                            $dateObj   = DateTime::createFromFormat('!m', $i);
                            $monthName = $dateObj->format('F'); // March

                       @endphp

                        @php

                            $selected = '';
                            if(isset($_GET['productOption'])){
                                if($_GET['productOption'] == $monthName){
                                $selected = 'selected';
                                }
                            } else if($monthName == date('F')){
                                $selected = 'selected';
                            }

                        @endphp
                        <option value="{{ $monthName }}" {{ $selected }}>{{ $monthName }}</option>
                   @endfor
                </select>
            </form>


            <canvas id="myChart" height="100px"></canvas>
            <script>
                var labels =   @json($labels) ;
                var sales =  @json($data) ;

                var count = {{ count($data) }}


                var color_array = [];
                function getRandomColor() {


                    var letters = '0123456789ABCDEF'.split('');
                    var color = '#';
                    for (var i = 1; i <= count; i++ ) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }

                    color_array.push(color);

                    return color_array;
                }

                var colors = getRandomColor();
                const data = {
                    labels: labels,



                    datasets: [{
                        fill: true,
                        label: 'Product Sales',
                        backgroundColor: ['rgb(255, 99, 132)', 'rgb(255, 99, 111)'],
                        borderColor: 'rgb(255, 99, 132)',
                        data: sales,
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,

                    options: {}
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );

                const filter = {
                    onInit: function () {
                        filter.initPalengkeFilter( $('#productOption') );
                    },

                    initPalengkeFilter: function(trigger){
                        trigger.change(function(e){

                            $('#sale-filter').submit();
                        });
                    },
                }

                $(document).ready(function () {
                    filter.onInit();
                })
            </script>


        </div>
    </div>
@endsection
