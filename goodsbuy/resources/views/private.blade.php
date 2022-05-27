@extends('layout.app')

@section('body')
<h1 class="header">Личный кабинет</h1>
<p>Добро пожаловать, {{Auth::user()->name}}!</p>
<p>Почта: {{Auth::user()->email}}</p>

@if(Auth::user()->name == 'admin')
<a href="{{ route('user.adminpanel') }}" class="btn btn-lg btn-primary btn-end"><h4 class="fw-normal head mb-1">Панель администратора</h4></a>
@endif

@endsection