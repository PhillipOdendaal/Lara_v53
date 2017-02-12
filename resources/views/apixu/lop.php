<?php

@foreach($weather['location'] as $k => $location)
    {{ $k }} : {{ $location }} 

@endforeach
    
        <!--
    @foreach($location as $details)
        {{$details['name']}}
    @endforeach
    -->

@foreach($weather['location'] as $location)
    Location name: {{ $location['name'] }}
    region name: {{ $location['region'] }}
    country name: {{ $location['country'] }}
    lon: {{ $location['lon'] }}
    lat: {{ $location['lat'] }}
    lat: {{ $location['lat'] }}
    tz_id: {{ $location['tz_id'] }}
    localtime_epoch: {{ $location['localtime_epoch'] }}
    localtime: {{ $location['localtime'] }}
@endforeach
@foreach($weather['current'] as $current)
    temp_c: {{ $location['temp_c'] }}
    temp_f: {{ $location['temp_f'] }}
    is_day: {{ $location['is_day'] }}
    temp_c: {{ $location['temp_c'] }}
    @foreach($location['condition'] as $condition)
        text: {{ $location['text'] }}
        icon: {{ $location['icon'] }}
        code: {{ $location['code'] }}
    @endforeach
    wind_mph: {{ $location['wind_mph'] }}
    wind_kph: {{ $location['wind_kph'] }}
    wind_degree: {{ $location['wind_degree'] }}
    wind_dir: {{ $location['wind_dir'] }}
    pressure_mb: {{ $location['pressure_mb'] }}
    pressure_in: {{ $location['pressure_in'] }}
    precip_mm: {{ $location['precip_mm'] }}
    humidity: {{ $location['humidity'] }}
    cloud: {{ $location['cloud'] }}
    feelslike_c: {{ $location['feelslike_c'] }}
    feelslike_f: {{ $location['feelslike_f'] }}

@endforeach


        {"location":{"name":"Paris","region":"Ile-de-France","country":"France","lat":48.87,"lon":2.33,"tz_id":"Europe/Paris","localtime_epoch":1486933488,"localtime":"2017-02-12 21:04"},
        "current":{"last_updated_epoch":1486933488,"last_updated":"2017-02-12 21:04","temp_c":8.0,"temp_f":46.4,"is_day":0,
                    "condition":{"text":"Clear","icon":"//cdn.apixu.com/weather/64x64/night/113.png","code":1000},
                "wind_mph":10.5,"wind_kph":16.9,"wind_degree":100,"wind_dir":"E","pressure_mb":1018.0,"pressure_in":30.5,"precip_mm":0.2,"precip_in":0.01,"humidity":81,"cloud":0,"feelslike_c":5.2,"feelslike_f":41.4}
    }
