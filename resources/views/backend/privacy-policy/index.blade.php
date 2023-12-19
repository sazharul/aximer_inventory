@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Privacy Policy</div>
                    <div class="card-body">

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Description</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($privacypolicy as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{!! substr(strip_tags($item->description), 0, 150) !!}</td>
                                        <td>
                                            <a href="{{ url('/privacy-policy/' . $item->id . '/edit') }}" title="Edit PrivacyPolicy"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $privacypolicy->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
