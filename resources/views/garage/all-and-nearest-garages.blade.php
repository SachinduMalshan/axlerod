{{-- <h1>All</h1>
@foreach ($garage_profiles as $garage_profile)
	<pre> {{ $garage_profile }}</pre>
@endforeach

<h1>Nearset</h1>
@foreach ($filtered_profiles as $filtered_profile)
	<pre> {{ $filtered_profile }}</pre>
@endforeach

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Google Map</title>
  <style>
    #map{
      height:400px;
      width:100%;
    }
  </style>
</head>
<body>
	<h1>My Google Map</h1>
	<div id="map"></div>
	<script>
		function initMap(){
			const user_latitude = parseFloat("{{ auth()->user()->latitude }}")
            const user_longtitude = parseFloat("{{ auth()->user()->longtitude }}")
			console.log(user_latitude, user_longtitude);
			var options = {
				zoom:15,
				center:{lat: user_latitude,lng: user_longtitude}
			}

			var map = new google.maps.Map(document.getElementById('map'), options);

			var filtered = @json($filtered_profiles);

			for(var i = 0;i < filtered.length;i++){
				console.log(filtered[i]);
				addMarker({
					coords:{lat: filtered[i].latitude, lng: filtered[i].longtitude},
					content:'<a href="/cusomer/view/'+filtered[i].garage_name+' | '+filtered[i].garage_mobno+'">'+filtered[i].garage_name+'</a>'

					
				});
			}

			function addMarker(props){
				var marker = new google.maps.Marker({
				position:props.coords,
				map:map,
				});

				if(props.iconImage){
					marker.setIcon(props.iconImage);
				}

				if(props.content){
					var infoWindow = new google.maps.InfoWindow({
						content:props.content
					});
					
					marker.addListener('click', function(){
						infoWindow.open(map, marker);
					});
				}
			}
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuRQucFhV9dLb9TBAp1yEnJgGCFnytOhQ&callback=initMap"> </script>
</body>
</html> --}}

@extends('layouts.app')

@section('content')
    <!-- ########## ^^^ Timeline Section ^^^ ########## -->
    <section id="timeline">
		<div class="mx-md-5">
			<div class="container">
				<div class="row">

					<!-- #####  Filter section ##### -->
					<x-posts-filter-section :vehicletypes="$vehicle_types"/>
					<!-- #####  Filter section end ##### -->

					<!--   Post section ##### -->
					<div class="col-md-6" id="post-section">

						<!-- Top head background image section -->
						<div class="imageBack mt-5 mb-2">
							<div class="card">
							<div class="card-body">
								<div class="mb-4">
								<form action="">
								<div class="input-group md-form form-sm form-2 pl-0">
									<input class="form-control my-0 py-1 " type="text" placeholder="Search" aria-label="Search">
									<div class="input-group-append">
									<button type="button" class="btn input-group-text " style="background-color: #2f98ef;"><i class="fas fa-search text-white"
										aria-hidden="true"></i></button>
									</div>
								</div>                    
								</form>
							</div>
							<div>
								<!--Google map-->
								<div class="map-responsive" id="map" style="width: 100%;height:340px;"></div>
								
								<!--Google Maps-->
							</div>
							</div>
							</div>
						</div><!-- Top head background image section end-->

						@foreach ($garage_profiles as $garage_profile)
							<!-- ++++++++++++++++++++++++++++ Map Profile Card - First Profile ++++++++++++++++++++++++++++ -->
							<div class="my-2">
								<div class="card roundedBox">

								<div class="card-body">
									<div class="d-flex">  <!-- Map Profile Card section - profile icon, Garage Name, verified, rating -->
								
									<div class="row ml-1">
										<div><!-- Profile icon div -->
										<img class="mr-2 rounded-circle userProfImg" src="{{ asset('assets/img/pro.png') }}" alt="profile_name"/>
										</div> <!-- Profile icon div end-->
				
										<div> <!-- Name  include tag -->
											<h5 class="mt-1">{{ $garage_profile->garage_name }}</h5>                        
										</div> <!-- Name  include tag end -->
									</div>
									
									<div class="ml-auto"> <!-- Verified and rating indicators -->
										<small class="bg-success px-2 text-white" style="border-radius:20px;" >Verified</small><br>
										<span class="ml-2"><i class="fa fa-star" style="color:#FFCD3C;"></i> 5.7</span>
									</div> <!-- Verified and rating indicators -->

									</div> <!-- Map Profile Card section - profile icon, Garage Name, verified, rating end -->

									<div class="mt-2"> <!-- Garage Details Body  -->
									<table>
										<tr>
											<td>Garage Owner Name: &nbsp;</td>
											<td>{{ $garage_profile->user->fname }} {{ $garage_profile->user->lname }}</td>
										</tr>
										<tr>
											<td>Contact Number:</td>
											<td>{{ $garage_profile->garage_mobno }}</td>
										</tr>
										<tr>
											<td>Location:</td>
											<td>
												@if ($garage_profile->address == NULL)
													{{ $garage_profile->location }}
												@else
													{{ $garage_profile->address }}
												@endif
												
											</td>
										</tr>
									</table>
									</div> <!-- Garage Details Body end  -->

								</div>

								<div class="card-footer">
									<a href="/cusomer/view/{{ $garage_profile->garage_name }} | {{ $garage_profile->garage_mobno }}" class="btn btn-sm goToProf"><i class="fa fa-address-card mr-1"></i> Go to Profile</a>
								</div>
								
								</div>
							</div> 
							<!-- ++++++++++++++++++++++++++++ Map Profile Card - First Profile end++++++++++++++++++++++++++++ -->
						@endforeach
						

            		</div>
					<!-- #####  Post section End ##### -->

					<!-- ####  Booking details side menu section #### -->
					<x-bookings-sidenav></x-bookings-sidenav>
					<!-- ####  Booking details side menu section end #### -->
				</div>
			</div>
		</div>
		<script>
			function initMap(){
				const user_latitude = parseFloat("{{ auth()->user()->latitude }}")
				const user_longtitude = parseFloat("{{ auth()->user()->longtitude }}")
				console.log(user_latitude, user_longtitude);
				var options = {
					zoom:15,
					center:{lat: user_latitude,lng: user_longtitude}
				}
	
				var map = new google.maps.Map(document.getElementById('map'), options);
	
				var filtered = @json($filtered_profiles);
	
				for(var i = 0;i < filtered.length;i++){
					console.log(filtered[i]);
					addMarker({
						coords:{lat: filtered[i].latitude, lng: filtered[i].longtitude},
						content:'<a href="/cusomer/view/'+filtered[i].garage_name+' | '+filtered[i].garage_mobno+'">'+filtered[i].garage_name+'</a>'
	
						
					});
				}
	
				function addMarker(props){
					var marker = new google.maps.Marker({
					position:props.coords,
					map:map,
					});
	
					if(props.iconImage){
						marker.setIcon(props.iconImage);
					}
	
					if(props.content){
						var infoWindow = new google.maps.InfoWindow({
							content:props.content
						});
						
						marker.addListener('click', function(){
							infoWindow.open(map, marker);
						});
					}
				}
			}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuRQucFhV9dLb9TBAp1yEnJgGCFnytOhQ&callback=initMap"> </script>
    </section> <!-- ######### ^^^ Timeline Section end ^^^ ######### -->

	<x-needhelp-modal :vehicletypes="$vehicle_types"/>
    <x-feedback-modal :vehicletypes="$vehicle_types"/>

@endsection