@extends('errors::layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('description', "Une erreur serveur est survenue. Nous examinons la situation.")
