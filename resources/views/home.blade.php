@extends('layouts.app')

@section('content-title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dashboard</h4>
                    {{-- <p class="card-category">Dashboard</p> --}}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
            <div style="direction: rtl;float: right;width: 300px;text-align: right">
                <ul>
                    <li>
                        <a href="/pick" style="font-family:Segoe UI;"> کنترل موجودی و ...</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
