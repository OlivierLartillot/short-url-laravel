@extends('layouts.base')

@section('content')

<h1>Le meilleur Raccourcisseur d'URL du marché</h1>
    
<form action="/" method="POST">
    {{ csrf_field() }}
    <input type="text" name="url" placeholder="Entre ton URL originale ici">
    <input type="submit" value="Raccourcir">
</form>
@endsection