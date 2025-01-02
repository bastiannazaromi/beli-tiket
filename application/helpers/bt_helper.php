<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function api_get($url, $query_data)
{
	$CI = &get_instance();

	$username_api = 'admin';
	$password_api = '12345678';

	$url_with_query = $url . '?' . http_build_query($query_data);

	$ch = curl_init($url_with_query);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPGET, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$username_api:$password_api");

	$headers = [
		'Accept: application/json',
	];

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		$CI->session->set_flashdata('error', curl_error($ch));

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	curl_close($ch);

	return json_decode($response);
}

function api_post($url, $data)
{
	$CI = &get_instance();

	$username_api = 'admin';
	$password_api = '12345678';

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_USERPWD, "$username_api:$password_api");

	$headers = [
		'Content-Type: application/x-www-form-urlencoded',
	];

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		$CI->session->set_flashdata('error', curl_error($ch));

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	curl_close($ch);

	return json_decode($response);
}

function api_delete($url, $data)
{
	$CI = &get_instance();

	// Basic Auth
	$username_api = 'admin';
	$password_api = '12345678';

	// Inisialisasi cURL
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_USERPWD, "$username_api:$password_api");

	$headers = [
		'Content-Type: application/x-www-form-urlencoded',
	];

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	// Eksekusi permintaan cURL
	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		$CI->session->set_flashdata('error', curl_error($ch));

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	curl_close($ch);

	return json_decode($response);
}

function api_put($url, $data)
{
	$CI = &get_instance();

	$username_api = 'admin';
	$password_api = '12345678';

	// Inisialisasi cURL
	$ch = curl_init($url);

	// Atur opsi cURL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_USERPWD, "$username_api:$password_api");

	$headers = [
		'Content-Type: application/x-www-form-urlencoded',
	];
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		$CI->session->set_flashdata('error', curl_error($ch));

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	curl_close($ch);

	return json_decode($response);
}
