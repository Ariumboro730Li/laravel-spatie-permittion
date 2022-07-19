@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
            </div>
            @role("penulis")
                <div class="card">
                  <div class="card-body">
                    <h4 class="text-danger">Penulis</h4>
                    @if (in_array("menulis-artikel", $permissions))
                        <h5>Menulis Artikel</h5>
                    @endif
                    @if (in_array("menulis-novel", $permissions))
                        <h5>Menulis Novel</h5>
                    @endif
                  </div>
                </div>
            @endrole
            @role("editor")
                <div class="card">
                  <div class="card-body">
                    <h4 class="text-warning">Editor</h4>
                  </div>
                </div>
            @endrole
            @role("pembaca")
                <div class="card">
                  <div class="card-body">
                    <h4 class="text-primary">Pembaca</h4>
                    @if (in_array("membaca-artikel", $permissions))
                        <h5>Membaca Artikel</h5>
                    @endif
                    @if (in_array("membaca-novel", $permissions))
                        <h5>Membaca Novel</h5>
                    @endif
                  </div>
                </div>
            @endrole
        </div>
    </div>
</div>
@endsection
