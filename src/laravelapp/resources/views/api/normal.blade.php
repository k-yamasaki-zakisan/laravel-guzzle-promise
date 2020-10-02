@extends('app')

@section('content')
<div class="container">
   @foreach( $data as $key => $val)
        {{ $key }}
   @endforeach
</div>
@endsection