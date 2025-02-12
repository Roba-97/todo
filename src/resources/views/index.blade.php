@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
	@if (session('message'))
	<div class="message-success">
		<span class="message-success__text">{{ session('message') }}</span>
	</div>
	@endif
	@if($errors->any())
		@foreach($errors->all() as $error)
		<ul class="message-error">
			<li class="message-error__text">{{ $error }}</li>
		</ul>
		@endforeach
	@endif

	<div class="todo-container">

		<div class="create-container">
			<h2>新規作成</h2>
			<form class="create-form" action="/todos" method="post">
				@csrf
				<div class="form__input-text">
					<input type="text" name="content" value="{{ old('content') }}">         
				</div>
				<div class="form__select-ctg">
					<select name="category_id">
						@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form__button">           
					<button class="form__button-create" type="submit">作成</button>
				</div>
			</form>
		</div>

		<div class="search-container">
			<h2>Todo検索</h2>
				<form class="search-form" action="/todos/search" method="get">
				@csrf
				<div class="form__input-text">
					<input type="text" name="keyword">         
				</div>
				<div class="form__select-ctg">
					<select name="category_id">
						@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form__button">           
					<button class="form__button-search" type="submit">検索</button>
				</div>
			</form>
		</div>
		
		<div class="todo-view">
			<div class="todo-view__group">
				<div class="todo-view__heading"><span>Todo</span></div>
				<div class="todo-view__heading"><span>Category</span></div>
			</div>
			@foreach ($todos as $todo)
			<div class="todo-view__group">	
				<div class="todo-view__update">
					<form action="/todos/update" method="post">
						@csrf
						@method('PATCH')
						<input type="hidden" name="id" value="{{ $todo->id }}"></input>
						<input class="todo-view__todo" type="text" name="content" value="{{ $todo->content }}"></input>
						<span class="todo-view__ctg" >{{ $categories->firstWhere('id', $todo->category_id)->name }}</span>
						<button class="todo-view__btn todo-view__btn--update" type="submit">更新</button>
					</form>
				</div>
				<div class="todo-view__delete">
					<form action="/todos/delete" method="post">
						@csrf
						@method('DELETE') 
						<input type="hidden" name="id" value="{{ $todo->id }}"></input>
						<button class="todo-view__btn todo-view__btn--delete" type="submit">削除</button>
					</form>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection