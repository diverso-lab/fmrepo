<div class="col-lg-12">
<button class="btn btn-primary" href="#" wire:click="load" wire:loading.attr="disabled">Load depositions and files from Zenodo</button>

    <button class="btn btn-primary" href="#"><em class="icon ni ni-upload"></em>  New deposition</button>

    <br><br>

    <div wire:loading>
        <div class="example-alert">
            <div class="alert alert-fill alert-light alert-icon">
                <em class="icon ni ni-loader"></em> Loading depositions...
            </div>
        </div>
        <br>
    </div>

    <div class="nk-block nk-block-lg">
        <div class="card card-preview">
            <div class="card-inner">
                <table id="depositions" class="datatable-init table">
                    <thead>
                    <tr>
                        <th>DOI</th>
                        <th>Title</th>
                        <th>State</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($depositions as $deposition)
                        <tr>
                            <td>{{$deposition->doi}}</td>
                            <td>{{$deposition->title}}</td>
                            <td>{{$deposition->state}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div> <!-- nk-block -->

    @section('scripts')

        <script>

            console.log("cargado");

            document.addEventListener('livewire', function () {

                console.log("recargaaaa");

            })

            /*
            $(document).ready(function() {
                var table = $('#depositions').DataTable();
                if (table instanceof $.fn.dataTable.Api) {
                    $('#depositions').DataTable().reload();
                } else {
                    $('#depositions').DataTable().ajax().reload();
                }
            });

             */


        </script>

    @endsection

</div>


