@extends('layouts.app')
@section('title')
    Phrase Analyes
@endsection
@section('content')
    <div class="content">
        <h1 class="p-5 font-italic font-weight-bold shadow bg-info text-white text-center">Phrase Analyse </h1>
        <div class=" mt-5 p-5 shadow text-dark ">

            <form action="{{url('/analyse/result')}}" method="POST" >
                @csrf
                <div class="form-group text-center ">
                    <label for="phrase" class="pb-4">Write A Phrase, please</label>
                    <textarea class="form-control text-center text-dark" name="phrase" id="phrase" maxlength="255" rows="3" placeholder="Write a string Max 255 Chr."></textarea>
                </div>
                
                {{-- Error Message --}}
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Oh!</strong> {{$error}}  try submitting again.
                    </div>
                    @endforeach
                @endif

                <div class="mt-4 text-right ">
                    <button type="submit" class="btn btn-primary px-5 py-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
<script>
var $limitNum = 255;
$('textarea[name="phrase"]').keydown(function() {
    var $this = $(this);

    if ($this.val().length > $limitNum) {
        $this.val($this.val().substring(0, $limitNum));
    }
});
</script>	
@endsection