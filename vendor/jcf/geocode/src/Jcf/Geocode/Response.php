<?php 
namespace Jcf\Geocode;

class Response
{
	public function __construct($response)
	{
		$this->response = $response['results'][0];
	}

	public function raw()
	{
		return (object) $this->response;
	}

	public function formattedAddress()
	{
		return $this->response['formatted_address'];
	}

	public function latitude()
	{
		return $this->response['geometry']['location']['lat'];
	}

	public function longitude()
	{
		return $this->response['geometry']['location']['lng'];
	}

	public function locationType()
	{
		return $this->response['geometry']['location_type'];
	}

	public function neighborhood(){
		return $this->response['address_components'][0]['long_name'];
	}

	public function locality(){
		return $this->response['address_components'][1]['long_name'];
	}

	public function administrative_area_level_2(){
		return $this->response['address_components'][2]['long_name'];
	}
}