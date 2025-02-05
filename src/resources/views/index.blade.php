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
	@error('content')
	<ul class="message-error">
		<li class="message-error__text">{{ $message }}</li>
	</ul>
	@enderror

	<div class="todo-container">
		<form class="making-form" action="/todos" method="post">
			@csrf
			<div class="form__input-text">
				<input type="text" name="content">         
			</div>
			<div class="form__button">           
				<button class="form__button-making" type="submit">作成</button>
			</div>
		</form>
		
		<div class="todo-view">
			<div class="todo-view__group">
				<div class="todo-view__heading"><span>Todo</span></div>
			</div>
			@foreach ($todos as $todo)
			<div class="todo-view__group">	
				<div class="todo-view__update">
					<form action="/todos/{{$todo->id}}" method="post">
						@csrf
						@method('PATCH') 
						<input class="todo-view__text" type="text" name="content" value="{{ $todo->content }}"></input>
						<button class="todo-view__btn todo-view__btn--update" type="submit">更新</button>
					</form>
				</div>
				<div class="todo-view__delete">
					<form action="/todos/delete?id={{$todo->id}}" method="post">
						@csrf
						@method('DELETE') 
						<button class="todo-view__btn todo-view__btn--delete" type="submit">削除</button>
					</form>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection