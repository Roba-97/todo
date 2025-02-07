@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
	@if (session('message'))
		<div class="message-success">
			<span class="message-success__text">{{ session('message') }}</span>
		</div>
	@endif
	@if ($errors->any())
		<ul class="message-error">
			@foreach ($errors->all() as $error)
			<li class="message-error__text">{{ $error }}</li>
			@endforeach
		</ul>
	@endif
	
	<div class="category-container">
		<div class="create-category">
			<form class="create-category__form" action="/categories" method="post">
				@csrf
				<div class="form__input-text">
					<input type="text" name="name" value="{{ old('name') }}">         
				</div>
				<div class="form__button">           
					<button class="form__button-create" type="submit">作成</button>
				</div>
			</form>
		</div>

		<div class="view-category">
			<table class="view-category__table">
				<tr class="view-category__row">
					<th class="view-category__heading">category</th>
				</tr>
				@foreach($categories as $category)
				<tr class="view-category__row">
					<td class="view-category__update">
						<form action="/categories/update" method="post">
							@csrf
							@method('PATCH')
							<input type="hidden" name="id" value="{{ $category->id }}"></input>
							<input class="category-view__text" type="text" name="name" value="{{ $category->name }}"></input>
							<button class="category-view__btn category-view__btn--update" type="submit">更新</button>
						</form>
					</td>
					<td class="view-category__delete">
						<form action="/categories/delete" method="post">
							@csrf
							@method('DELETE')
							<input type="hidden" name="id" value="{{ $category->id }}"></input>
							<button class="category-view__btn  category-view__btn--delete" type="submit">削除</button>
						</form>
					</td>
				</tr>
				@endforeach 
			</table>
		</div>

	</div>


@endsection