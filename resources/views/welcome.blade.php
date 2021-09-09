@extends('layouts.frontend.frontend')
@section('content')

<public-search v-if="search == true"></public-search>
<public-history v-if="history == true"></public-history>
<public-function v-if="func == true"></public-function>
       
@endsection
