@extends('laravel-usp-theme::master')

@section('javascripts_head')

@section('content')
@include('flash')

<form method="POST" action="/item">
    @csrf
    @include('item/form')
    <div>
        <button type="submit" class="btn btn-info" value="salvar">Salvar</button>
    </div>
    
    <br>
</form>

@endsection('content')

@section('javascripts_bottom')
    <script>
        jQuery.fn.preventDoubleSubmission = function() {
        $(this).on('submit',function(e){
            var $form = $(this);
            if ($form.data('submitted') === true) {
                e.preventDefault();
            } else {
                $form.data('submitted', true);
            }
        });
            return this;
        };

        $('form').preventDoubleSubmission();
        jQuery.fn.disableEnter = function() {
            $('form').keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
            });
        };
        $('form').disableEnter();

    </script>
@endsection