@extends('layouts.app')
<style>
.container-fluid{
    height: 100px;
    width: 300px;
}
#search{
    text-align: center;
    height: 200px;
    width: 500px;
}
#show{
        text-align: center;
    }
    .num{
        font-size: 30px;
        font-family: sans-serif;
    }

.location{
        font-size: 40px;
        font-family: "Courier New";
    }
</style>
@section('content')


<div class="site-content">
    <div class="site-header">
        <div class="container">
            <a href="index.html" class="branding">
                <img src="images/logo.png" alt="" class="logo">
            </a>


            <div class="mobile-navigation"></div>

        </div>
    </div> <!-- .site-header -->

    <div class="hero" data-bg-image="images/banner.png">
        <div class="container-fluid" id="search" >
            <form action="{{url('user/map')}}" class="find-location" method="POST">
                @method('GET')
                <input type="text" placeholder="Find your location..." class="" name="location">
                <input type="submit" value="Find" class="btn btn-success">
            </form>

            <form action="{{url('user/map')}}" class="find-location" method="POST">
                @method('GET')
{{--                <input type="submit" placeholder="Use My Lcoation" class="" name="locationgps">--}}
                <input type="submit" value="Use My Location" class="btn btn-success" name="locationgps">
            </form>

{{--          <button class="btn btn-dedault" onclick="getlocation()"> Use loc</button>--}}
        </div>
    </div>

    <div class="forecast-table">
        <div class="container" id="show">
            <div class="forecast-container">

                <div class="today forecast">
                    <div class="forecast-header">
                        <div class="day"></div>
                        <div class="date">{{date('d-m-Y ')}}</div>
                    </div> <!-- .forecast-header -->
                      <div class="forecast-content">
                         <div class="location">{{$data->name}}</div>
                            <div class="degree">
                              <div class="num">{{number_format($data->main->temp, 0, '.', ',')}}<sup>o</sup>C</div>
                                  <div class="forecast-icon">
{{--                                <img src="images/icons/icon-1.svg" alt="" width=90>--}}
                              </div>
                           </div>
                        </div>
                    </div>
               </div>
           </div>
        </div>
              <footer class="site-footer">
                    <p class="colophon"></p>
              </footer>
</div>






@endsection
