<div class="m-3">
    @can('survey_detail_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.survey-details.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.surveyDetail.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.surveyDetail.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-askTypeSurveyDetails">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.surveyDetail.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.surveyDetail.fields.ask') }}
                            </th>
                            <th>
                                {{ trans('cruds.surveyDetail.fields.response') }}
                            </th>
                            <th>
                                {{ trans('cruds.surveyDetail.fields.survey') }}
                            </th>
                            <th>
                                {{ trans('cruds.surveyDetail.fields.ask_type') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surveyDetails as $key => $surveyDetail)
                            <tr data-entry-id="{{ $surveyDetail->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $surveyDetail->id ?? '' }}
                                </td>
                                <td>
                                    {{ $surveyDetail->ask ?? '' }}
                                </td>
                                <td>
                                    {{ $surveyDetail->response ?? '' }}
                                </td>
                                <td>
                                    {{ $surveyDetail->survey->name ?? '' }}
                                </td>
                                <td>
                                    {{ $surveyDetail->ask_type->name ?? '' }}
                                </td>
                                <td>
                                    @can('survey_detail_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.survey-details.show', $surveyDetail->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('survey_detail_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.survey-details.edit', $surveyDetail->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('survey_detail_delete')
                                        <form action="{{ route('admin.survey-details.destroy', $surveyDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('survey_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.survey-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-askTypeSurveyDetails:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection