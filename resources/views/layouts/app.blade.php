@extends('light-bootstrap-dashboard::layouts.main')

@section('sidebar-menu')
<ul class="nav">
  <li class="active">
    <a class="nav-link" href="{{ route('home') }}">
      <i class="pe-7s-home"></i>
      <p>Home</p>
    </a>
    <a class="nav-link" href="{{ route('pick') }}">
      <i class="pe-7s-home"></i>
      <p>کنترل موجودی</p>
    </a>
  </li>
</ul>
@endsection
