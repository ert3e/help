@extends('layouts.app')

@section('content')

    <br>
    <div class="btn-group flex align-items-center">
        <span class="mr-2"><strong>Группировка:</strong></span>

        <a href="{{ route('admin.feedbacks') }}" class="btn btn-outline-primary {{ !isset($_GET['type']) ? 'active' : '' }}" aria-current="page">Все</a>
        @foreach(FeedbackBase::getTypes() as $type => $feedback)
            <a href="{{ route('admin.feedbacks', ['type' => $type]) }}" class="btn btn-outline-primary {{ isset($_GET['type']) && $_GET['type'] == $type ? 'active' : '' }}" aria-current="page">{{ $feedback }}</a>
        @endforeach
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Имя/Фамилия', 'field' => 'name'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Телефон', 'field' => 'telephone'])</th>
                    <th>@include('templates.titleSort', ['title' => 'E-mail', 'field' => 'email'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Тип', 'field' => 'type'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Дата', 'field' => 'created_at'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Обращение', 'field' => 'description'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Сбросить', 'field' => '-'])</th>
                </tr>
            </thead>
            <tbody>
            @if ($feedbacks->count() == 0)
                <tr class="empty-items"><td colspan="6">Записей пока нет</td></tr>
            @else
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->telephone }}</td>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->getType() }}</td>
                        <td>{{ date('d.m.Y H:i', strtotime($feedback->created_at)) }}</td>
                        <td>
                            {!! getFile('feedbacks/'.$feedback->id, 'Прикрепленный файл', 'badge bange-sm badge-primary') !!}
                            {{ $feedback->description }}</td>
                        <td>
                            @include('templates.buttonsControl', [
                                'delete'    => route('admin.feedbacks.delete', $feedback['id']),
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>

    @include('templates.paginator', ['paginator' => $feedbacks])


@endsection

