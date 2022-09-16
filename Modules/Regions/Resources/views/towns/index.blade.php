@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.town_list_msg') @endsection
@section('title') @lang('admin.town_list_msg') @endsection
@section('content')
    <div class="container p-2">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap">
                <a href="#">
                    <button type="button" onclick="addTown()" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('admin.add_towns')}}
                    </button>
                </a>
            </div>
        </div>
        @if (Session::has('message'))
            <div class="row"
                 style="border: 1px solid #ccc; padding: 5px; border-radius: 10px; margin-right: 5%; color: #40c940; background-color: #d9f1d9">
                {{ Session::get('message') }}
            </div>
        @endif
        {{-- adding a town --}}
        <div class="row card-deck helep_round my-5" id="addTown"
             style="border-radius: 10px; border: 1px solid #ccc; padding: 8px; margin-right: 5%; margin-bottom: 3%">
            <div class="container p-5 " id="hide">
                <div class="text-center" id="message">
                    <p class="alert helep_alert_round helep-color text-center"> Add a new Town by filling the fields
                        below
                    </p>
                </div>
                <div class="row text-center">
                    <div class="col-md-3 form-group">
                        <select class="form-control" name="country" id="country" onchange="getTowns(event)">
                            <option value="">Select country</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select class="form-control" name="region" id="region" onchange="selectRegion(event)">
                            <option value="">Select region</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group" id="town">
                        <input class="form-control" type="text" name="town" placeholder="Enter town name"
                               id="selecetedName" onchange="dofun(event)">
                    </div>
                    <div class="col-md-3 form-group" id="button" style="font-size: 13px !important">
                        <button type="button" class="btn helep_btn_raise" style="font-size: 13px !important"
                                onclick="submitVal()">
                            {{trans('shop.add_town_select_town')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end adding town --}}
        <table id="townTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Region</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php $counter=0; @endphp
            @foreach($towns->sortDesc() as $town)
                <tr>
                    <td>{{++$counter}}</td>
                    <td>{{$town->name}}</td>
                    <td>{{$town->region->name}}</td>
                    <td>{{$town->region->country->name}}</td>
                    <td>
                        <a id="{{$town->id}}" onclick="showUpdateTownModal(this)" rel="{{$town->name}}" class="text-muted p-1 m-1"><i
                                class=" fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a>
                        <a href="{{route('delete_town',['id'=>$town->id])}}"
                           onclick="return confirm('Delete Now ?');" class="text-muted"><i
                                class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal modal-primary" id="updateTownDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header helep-color">
                    <h3 class="modal-title" id="myModalLabel">Update Town Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="errorMessage"></div>
                        <div class="col-md-8 form-group">
                            <select class="form-control" name="country" id="country" onchange="getTowns(event)">
                                <option value="">Select country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <select class="form-control region" name="region" onchange="selectRegion(event)">
                                <option value="">Select region</option>
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <input class="form-control" type="text" name="town" placeholder="Enter town name"
                                   id="selectedTown">
                            <input type="hidden" id="selectedTownId" value=""/>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button onclick="updateTown(this)" id="updateTownBtn" type="button" class="btn helep_btn_raise">Save
                        changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("css")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection

@section('js')
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js">
    </script>
    <script>
        $(function () {
            //set link indicator
            $('#townTable').DataTable(
                {
                    "order": [[0, "asc"]]
                }
            );
        });
    </script>
    <script>
        var cid;
        var regionId;
        var townName;
        $("#addTown").hide();
        // $("#town").hide();
        $("#button").hide();
        // $.ajaxSetup({
        //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        //     });
        function addTown() {
            console.log('none');
            if ($("#addTown").is(':visible')) {
                $("#addTown").hide(100);
            } else {
                $("#addTown").fadeIn(100);
            }
        }

        function showUpdateTownModal(obj) {
            // var town_id = $("#".obj.id).
            var town_id = obj.id;
            var town_name = obj.rel;
            $("#selectedTown").val(town_name);
            $("#selectedTownId").val(town_id);
            $("#updateTownDialog").modal('show');
        }

        function updateTown() {
            $("#updateTownBtn").prop('disabled', true);
            var townId = $("#selectedTownId").val();
            var townName = $("#selectedTown").val();
            var region = $(".region").val();
            if (townName === "") {
                alert("Kindly enter a value as name for the selected town to update");
                return;
            }
            if (region === "none") {
                alert("Kindly select a region to update the selected town");
                return;
            }
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                datatype: "json",
                type: 'post',
                data: {
                    townName: townName,
                    region: region
                },
                url: $("#baseUrl").val() + '/regions/towns/' + townId,
                success: function (response) {
                    //console.log(JSON.parse(response));
                    $("#updateTownDialog").modal('hide');
                    window.location.reload();
                },
                error: function (err) {
                    console.log(err);
                    $("#errorMessage").html("<p class='alert alert-danger'>An error occured while updating town. Please try again</p>");
                }
            });
        }

        function getTowns(event) {
            this.cid = event.target.value;
            $("#region").empty();
            $("#region").append("<option value='none'>Please Wait ....</option>");
            $.ajax({
                datatype: "json",
                type: 'get',
                data: {
                    countryId: event.target.value
                },
                url: "{{route('get_towns_by_country_id')}}",
                success: function (response) {
                    $("#region").empty();
                    $("#region").append(response);
                    $(".region").append(response);

                },
                error: function (err) {
                    console.log(err);
                    $("#region").append("<option value='none'>Select region</option>");
                }
            });
        }

        function selectRegion(e) {
            console.log("eve: ", e.target.value);
            this.regionId = e.target.value;
            $("#town").fadeIn(100);
            setTimeout(() => {
                $("#button").fadeIn(100);
            }, 1000);
        }

        function dofun(e) {
            this.townName = e.target.value;
        }

        function submitVal() {
            $("#button").hide();
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                datatype: "json",
                type: 'post',
                data: {
                    town: this.townName,
                    region: this.regionId
                },
                url: "{{route('save_town')}}",
                success: function (response) {
                    if (response[0] === 'error') {
                        $('#message').empty();
                        $('#message').append(response[1]);
                        $("#button").show();
                        return;
                    }
                    $('#message').empty();
                    $('#message').append(response[1]);
                    $("#hide").hide();
                    window.location.reload();
                },
                error: function (er) {
                    console.log(er);
                }
            });
        }
    </script>
@endsection
