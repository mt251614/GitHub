@extends('layouts.default')
@section('content')

<h1 class="main_01">GPS Location</h1>

@if(session('success'))
<div>{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('location.store') }}">
    @csrf
    <label for="customer_name" class="main_02">長輩名字:</label><br>
    <input type="text" id="customer_name" name="customer_name" required class="main_03"><br>

    <label for="driver_name" class="main_04">司機名字:</label><br>
    <input type="text" id="driver_name" name="driver_name" required class="main_05"><br><br><br>

    <label for="latitude">緯度:</label>
    <input type="text" id="latitude" name="latitude" required class="main_06"><br>

    <label for="longitude">經度:</label>
    <input type="text" id="longitude" name="longitude" required class="main_07"><br>

    <button type="submit">傳送</button>
</form><br>

<button onclick="getLocation()" class="main_08">獲得經緯度</button>

<form method="POST" action="{{ route('location.export') }}">
    @csrf
    <label for="driver">依司機篩選：</label>
    <input type="text" id="driver" name="driver" required><br>

    <button type="submit">匯出 CSV</button>
</form>



@stop