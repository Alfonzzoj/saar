
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    <h3 class="box-title">Filtros</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div><!-- /.box-tools -->
                </div>
                <div class="box-body text-right">
                        @include('cliente.partials.filters', ["resetHref" => "javascript:void(0)"])
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Clientes</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            @include('cliente.partials.table', ["selectButton" => true])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>