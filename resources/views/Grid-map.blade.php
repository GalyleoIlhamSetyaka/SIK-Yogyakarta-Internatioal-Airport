@extends('layouts.app')
@php
    $selectedGrid = $selectedGrid ?? null;
@endphp
@section('content')
@livewire('grid-map-component')
@endsection
