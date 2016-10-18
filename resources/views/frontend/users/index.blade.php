@extends('templates.master')

@section('content')
    @include('frontend.users.templates.nav')

    <div class="container">

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script>
contry_code = google.loader.ClientLocation.address.country_code
city = google.loader.ClientLocation.address.city
region = google.loader.ClientLocation.address.region
</script>
    </div>
@stop