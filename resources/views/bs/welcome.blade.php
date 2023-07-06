@extends('layouts.bootstrap')

@section('content')
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">{{ config('app.name') }}</a>
            <div>
                <a class="px-2 text-black text-decoration-none" href="/register">Register</a>
                <a class="px-2 text-black text-decoration-none" href="/login">Login</a>
            </div>
        </div>
    </nav>

    <main class="mt-5 container">
        <h1>Software engineer test - Type E</h1>
        <hr class="my-4">
        <h3>Objective:</h3>
        <p>The objective of this assignment is to build web application using Laravel that incorporates various features such as authentication, authorization, email notifications, third-party API integration, and more. You will need to create a custom database schema with multiple tables, and implement the necessary functionality to manage the data stored in those tables.</p>
    </main>
@endsection
