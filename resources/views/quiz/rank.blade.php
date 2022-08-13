@extends('layouts.base')
@section('menu')
@endsection
    @section('conteudo')
    <div class="container">
        <br><br>
        <table class="table table-dark table-striped text-center">
            <thead>
                <tr>
                    <th>TOP</th>
                    <th>Nome</th>
                    <th>Pontos</th>
                </tr>
            </thead>
            <tbody>
                @php $n = 1 @endphp
                @foreach ($users as $item)
                <tr>
                    <th>{{$n}}°</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->pontos}}</td>
                </tr>
                @php $n++ @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endsection
    
    @section('script')
@parent
@endsection