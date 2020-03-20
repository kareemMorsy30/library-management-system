@extends('layouts.app')

@section('links')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<meta charset="utf-8">
@endsection

@section('content')
<!-- HTML Markup -->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <section class="card">
                <div class="card-header">
                    <h4 class="card-title">Maktabty Activity</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">

                    <div class="card-block">
                    {!! $borrowChart->container() !!}
                    </div>

                </div>
            </section>
        </div>
    </div>
</div>
<!--/ HTML Markup -->
@endsection

@section('scripts')
{{-- ChartScript --}}
    @if($borrowChart)
    {!! $borrowChart->script() !!}
    @endif
@endsection