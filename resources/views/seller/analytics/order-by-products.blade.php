@extends('layouts.seller')

@section('content')
    <div class="profile" style="padding: 60px;">
        <div class="profile-wrapper" >


            <form action="" class="form-group col-5" method="GET" id="sale-filter">

                <div class="" style="width: 100%; display: flex">
                    <div class="form-group short    ">
                        <label for="">Month></label>
                        <select  class="form-control" id="productOption" name="productOption" placeholder="Order By"  >
                            <option value=""></option>
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
                    </div>
                   {{-- <div class="form-group short">
                        <label for="">Year</label>
                        <select  class="form-control" id="year" name="year" placeholder="Order By"  >
                            <option value=""></option>
                            @php $year= date('Y') - 10; @endphp
                            @for($i = date('Y'); $i >= 2015; $i--)
                                <option value="{{ $i }}" {{ isset($_GET['year']) && $_GET['year'] ==  $i  ? 'selected' : ''  }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>--}}
                    <div class="form-group short    ">
                        <label for="">Category</label>
                        <select  class="form-control" id="category" name="category" placeholder="Category"  >
                            <option value=""></option>
                            @foreach(\App\Categories::all() as $category)
                                <option value="{{ $category->category }}" {{ (isset($_GET['category']) && $_GET['category'] == $category->category ? 'selected' : '')  }}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group short    ">
                        <label for="">Sort</label>
                        <select  class="form-control" id="sort" name="sort" placeholder="Category"  >
                            <option value="desc" {{ (isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'selected' : '')  }}>Sales (Highest - Lowest)</option>
                            <option value="asc" {{ (isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : '')  }}>Sales (Lowest - Highest)</option>
                        </select>
                    </div>


                </div>

            </form>


            <canvas id="myChart" height="100px"></canvas>

            <button id="downloadCSV">Download </button>
            <script>
                var labels =   @json($labels) ;
                var sales =  @json($data) ;

                var count = {{ count($data) }}


                var color_array = [];
                function getRandomColor() {
                    var letters = '0123456789ABCDEF'.split('');
                    var color = '#';

                    for (var i = 1; i <= count; i++ ) {
                        let maxVal = 0xFFFFFF; // 16777215
                        let randomNumber = Math.random() * maxVal;
                        randomNumber = Math.floor(randomNumber);
                        randomNumber = randomNumber.toString(16);
                        let randColor = randomNumber.padStart(6, 0);
                        color = `#${randColor.toUpperCase()}`;

                        color_array.push(color);
                    }


                    console.log(color_array);
                    return color_array;
                }

                var backgroundColors =  getRandomColor();
                const data = {

                    labels: labels,


                    datasets: [
                        {
                            dataPercentage: 0.1,
                            fill: true,
                            label: 'Product Sales',
                            data: sales,
                            backgroundColor: backgroundColors,
                            borderColor: backgroundColors,
                            borderWidth: 1
                        },

                    ]
                };

                const config = {
                    type: 'bar',
                    data: data,

                    options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );



                const filter = {
                    onInit: function () {
                        filter.initPalengkeFilter( $('select') );
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
