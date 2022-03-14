<div class="modal fade bs-settings-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Настройка модуля:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modal-body">

                {{ Form::open(['route' => 'admin.settings.save']) }}

                    @if (!isset($showPaginateFields) || (isset($showPaginateFields) && $showPaginateFields))
                        <h3>Пагинация:</h3>
                        <div class="form-group">
                            <label for="paginate_page">Количество элементов на странице: </label>
                            {{ Form::input('number', 'settings['.$module.'][paginate_page]', setting($module.'.paginate_page'),  ['id' => 'paginate_page', 'class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            <label for="paginate_main">Количество элементов на главной: </label>
                            {{ Form::input('number', 'settings['.$module.'][paginate_main]', setting($module.'.paginate_main'),  ['id' => 'paginate_main', 'class' => 'form-control']) }}
                        </div>
                    @endif

                    @include('templates.seo')

                    {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}

                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
