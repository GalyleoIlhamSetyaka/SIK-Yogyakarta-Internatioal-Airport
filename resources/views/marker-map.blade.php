@extends('layouts.app')
@php
    $selectedGrid = $selectedGrid ?? null;
@endphp
@section('content')
@livewire('marker-map')
@endsection
