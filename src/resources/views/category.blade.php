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
	@error('content')
		<ul class="message-error">
			<li class="message-error__text">{{ $message }}</li>
		</ul>
	@enderror
	

	<div class="category-container">
		<div class="create-category">
			<form class="create-category__form" action="/categories" method="post">
				@csrf
				<div class="form__input-text">
					<input type="text" name="name">         
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
						<form  action="" method="post">
							@csrf
							@method('PATCH') 
							<input type="text" name="id" value="{{ $category->id }}" hidden></input>
							<input class="category-view__text" type="text" name="name" value="{{ $category->name }}"></input>
							<button class="category-view__btn category-view__btn--update" type="submit">更新</button>
						</form>
					</td>
					<td class="view-category__delete">
						<form action="" method="post">
							@csrf
							@method('DELETE') 
							<button class="category-view__btn  category-view__btn--delete" type="submit">削除</button>
						</form>
					</td>
				</tr>
				@endforeach 
			</table>
		</div>

	</div>


@endsection