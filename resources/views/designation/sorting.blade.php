@extends('layouts.master')
@section('title','Designation | Sorting')
@section('local_css')
    {{--datatable css--}}
    <link href="{{url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{url('build/css/kendo.common.min.css')}}" rel="stylesheet">
    <link href="{{url('build/css/kendo.default.min.css')}}" rel="stylesheet">
    <link href="{{url('build/css/kendo.default.mobile.min.css')}}" rel="stylesheet">

    <link href="{{url('build/css/cover.spin.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    @include('partials.flushMessage')
                    @yield("flushError")
                    @yield("flushSuccess")
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="cover-spin"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <h2>Designations</h2>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="treeview-designation"></div>
                            <button class="k-primary k-button" id="updateTreeViewData">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script src="{{url('build/js/kendo.all.min.js')}}"></script>
    <script>
        var arr = [];
        function setSort(items, treeview) {
            for (var i = 0; i < items.length; i++) {
                var nObj = {
                    parent: null,
                    parentTitle: null,
                    id: null,
                    childTitle: null
                }
                if ($(items[i]).parent("ul.k-group").length === 1) {
                    console.log('top level node')
                }
                var title = items[i].title;
                var parent = treeview.parent(treeview.findByText(title));
                if (parent.length > 0) {
                    parent = parent.data("uid")
                    destinationParent = treeview.dataSource.getByUid(parent);
                    nObj.parent = destinationParent.id;
                    nObj.parentTitle = destinationParent.title;
                    nObj.id = items[i].id;
                    nObj.childTitle = items[i].title;
                    arr.push(nObj)
                }else{
                    nObj.id = items[i].id;
                    nObj.childTitle = items[i].title;
                    arr.push(nObj)
                }
                if (items[i].hasChildren) {
                    setSort(items[i].children.view(), treeview);
                }
            }
            //console.log(arr)
        }


        $('#updateTreeViewData').click(function (e) {
            e.preventDefault();
            var mainTree = $("#treeview-designation");
            var treeview = mainTree.data("kendoTreeView");
            var treeviewDataSource = mainTree.data("kendoTreeView").dataSource.view();
            //console.log('Updated Source:',treeviewDataSource)
            arr=[];
            setSort(treeviewDataSource, treeview);
            updateSortedDesignation(arr)
            console.log(arr)
        })
        function updateSortedDesignation(arr){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: APP_URL + '/updateHierarchy',
                type: "POST",
                dataType: "json",
                data: {records:arr},
                //success: onSkipDataReceived
                beforeSend: function () {
                    $('#cover-spin').show(0)
                },
                success: function (data) {
                    $(self).closest('.costingArea').find('.food_cost').val(data.total_meal_cost);
                    // console.log(data.total_meal_cost)
                },
                complete: function () {
                    $('#cover-spin').hide(0)
                },
                error: function () {
                    alert("Error occurred")
                    $('#cover-spin').hide(0)
                }
            })
        }


        $("#treeview-designation").kendoTreeView({
            dragAndDrop: true,
            dataSource: {!! $treeList !!},
            dataTextField: 'text',
            dataValueField: 'id',
            //drop: onDrop
        });
    </script>
@endsection
