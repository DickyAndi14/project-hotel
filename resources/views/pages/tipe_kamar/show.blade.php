{!! Form::model($model, ['id' => 'formShow']) !!}
    <div class="row">
        <div class="col-md-3">
            <h6>Tipe Kamar :</h6>
        </div>
        <div class="col-md-9">
            <p>{{ $model->name }}</p>
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
    </div>
{!! Form::close() !!}