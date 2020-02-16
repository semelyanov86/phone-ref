@extends('layouts.app')

@section('content')
<create-component
    :operator="{{ $operator }}"
    :balance="{{ $balance }}"
    createurl="{{ route('payment.make') }}"
    :user="{{ $user }}"
    :ins="{{ $ins }}"
    :outs="{{ $outs }}"
></create-component>
@endsection
