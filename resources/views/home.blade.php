@extends('layouts.master')

@section('titulo','Início')

@section('conteudo')
    <p>{{ Auth::user()->email }}</p>
@endsection
