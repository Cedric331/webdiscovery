@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('description', "Trop de requetes envoyees. Patientez quelques instants et reessayez.")
