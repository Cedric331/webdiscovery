@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@section('description', "Acces restreint. Connectez-vous ou contactez l'equipe si besoin.")
