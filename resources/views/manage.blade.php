@extends('layouts.app')
@section('content')
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">File</th>
            <th scope="col">Status</th>
            <th><span class="fa fa-check"></span></th>
            <th><span class="fa fa-trash"></span></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($instructions as $instruction)
            <tr>
                <th scope="row">{{$instruction->id}}</th>
                <td>{{$instruction->title}}</td>
                <td><a href="/instruction/{{$instruction->id}}/downloadAdmin">Download File</a></td>
                <td>{{$instruction->is_approved ? "Approved" : "Pending"}}</td>
                <td>
                    @if ($instruction->is_approved !== 1)
                        <a href="/instruction/{{$instruction->id}}/stateMutate" class="badge badge-info" style="padding:10px;">APPROVE</a>
                    @else
                        <a href="/instruction/{{$instruction->id}}/stateMutate" class="badge badge-warning" style="padding:10px;">DENY</a>
                    @endif

                </td>
                <td><a href="/instruction/{{$instruction->id}}/delete" class="badge badge-danger" style="padding:10px;">DELETE</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>


@endsection
