@extends('layouts.whole')
@section('content')
     
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Funding Agencies</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Organization</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <organizations :org_id="4"></organizations>
       
@endsection
