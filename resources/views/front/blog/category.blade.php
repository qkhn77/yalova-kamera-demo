@extends("front.layouts.app")

@section("content")

<div class="container py-5">

<h1>{{ $category->name ?? "Kategori" }}</h1>

<div class="row">

@forelse($posts ?? [] as $post)

<div class="col-lg-4 col-md-6">

@include("front.partials.cards.blog-card",["post"=>$post])

</div>

@empty

<p>Bu kategoride içerik yok.</p>

@endforelse

</div>

</div>

@endsection
