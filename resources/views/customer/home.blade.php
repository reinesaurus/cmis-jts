@extends('layouts.customer')

@section('content')

<h3>Total Points</h3>

<div class="points-card">
    <p>Total Points</p>
    <h2>{{ session('customer')->points_balance ?? 0 }}</h2>
</div>


<h3 style="margin-top:20px;">Recent Transactions</h3>

<table>
<tr>
    <th>Transaction</th>
    <th>Amount</th>
    <th>Points</th>
</tr>

<tr>
    <td>Purchase</td>
    <td>500000</td>
    <td>50</td>
</tr>

</table>

@endsection