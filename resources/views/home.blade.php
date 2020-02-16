@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Choose operator</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach($operators as $operator)
                            <div class="col-sm-6 mt-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{asset($operator->logo)}}" class="card-img-top" alt="{{$operator->name}}" height="155px">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$operator->name}}</h5>
                                        <p class="card-text">{{$operator->description}}</p>
                                        <a href="{{route('payment', ['id' => $operator->id])}}" class="btn btn-primary">Make payment to {{$operator->name}}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
