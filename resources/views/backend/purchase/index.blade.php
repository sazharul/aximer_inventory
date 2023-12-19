@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             
                 <div class="card-body">
                  
                        <div class="row">
                            <div class="col-md-10">
                             
                                <input type="text" name="search" id="search" placeholder="Enter search name" class="form-control mb-3" onfocus="this.value=''">
                              
                            </div>
                           
                        </div>
                 
                    <div id="search_list"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#search').on('keyup',function(){
            var query= $(this).val(); 
            $.ajax({
                url:"search",
                type:"GET",
                data:{'search':query},
                success:function(data){ 
                    $('#search_list').html(data);
                }
            });
             //end of ajax call
        });
    });
</script>
@endpush