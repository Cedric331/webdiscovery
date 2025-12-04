@extends('errors::layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('description', "Le service est temporairement indisponible. Revenez un peu plus tard.")
