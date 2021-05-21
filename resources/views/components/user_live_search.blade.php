@section('local_guest_style')
    <style>

        /*.k-dropdown-wrap.k-state-hover {*/
        /*    border-color: darkblue;*/
        /*    background: lightblue;*/
        /*}*/

        /*.k-dropdown-wrap .k-icon {*/
        /*    !*color: red !important;*!*/
        /*}*/

        /*.k-dropdown-wrap .k-icon:before {*/
        /*    !*content: "\e120";*!*/
        /*    content: "\01f50d";*/
        /*    !*content: "<span class='k-icon k-i-search'></span>";*!*/
        /*}*/


        #toolbar-parent {
            margin: 0 auto;
        }
        /*who were involved multiselect*/
        .dropdown-header {
            border-width: 0 0 1px 0;
            text-transform: uppercase;
        }

        .dropdown-header > span {
            display: inline-block;
            padding: 10px;
        }

        .dropdown-header > span:first-child {
            width: 50px;
        }

        .k-list-container > .k-footer {
            padding: 10px;
        }

        .selected-value {
            display: inline-block;
            vertical-align: middle;
            width: 18px;
            height: 18px;
            background-size: 100%;
            margin-right: 5px;
            border-radius: 50%;
        }

        #u_keyword,
        #u_keyword_overflow .k-item {
            line-height: 1em;
            min-width: 300px;
        }

        /* Material Theme padding adjustment*/

        .k-material [id*='who_ware_involved'] .k-item,
        .k-material [id*='who_ware_involved'] .k-item.k-state-hover,
        .k-materialblack [id*='who_ware_involved'] .k-item,
        .k-materialblack [id*='who_ware_involved'] .k-item.k-state-hover {
            padding-left: 5px;
            border-left: 0;
        }

        .k-item > span {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            display: inline-block;
            vertical-align: top;
            margin: 20px 10px 10px 5px;
        }

        .k-item > span:first-child {
            -moz-box-shadow: inset 0 0 30px rgba(0, 0, 0, .3);
            -webkit-box-shadow: inset 0 0 30px rgba(0, 0, 0, .3);
            box-shadow: inset 0 0 30px rgba(0, 0, 0, .3);
            margin: 10px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-size: 100%;
            background-repeat: no-repeat;
        }

        #u_keyword,
        #u_keyword_overflow h3 {
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 1px 0;
            padding: 0;
        }

        #u_keyword,
        #u_keyword_overflow p {
            margin: 0;
            padding: 0;
            font-size: .8em;
        }

    </style>
@endsection

<form action="" class="form-horizontal" id="thisForm" method="get">
    <div id="toolbar"></div>
</form>
@section('guestPageJs')
    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                var autocomplete = $("#live-user-search").kendoAutoComplete({
                    minLength: 1,
                    {{--value: "{{(Auth::user())->pin}}",--}}
                    dataTextField: "text",
                    dataValueField: "id",
                    // headerTemplate:
                    //     '<div class="dropdown-header k-widget k-header">' +
                    //     '<span>Photo</span>' +
                    //     '<span>User info</span>' +
                    //     '</div>',
                    footerTemplate: 'Total #: instance.dataSource.total() # items found',
                    valueTemplate:
                        '<span class="selected-value" style="background-image: url(\'#:APP_URL#/storage/user-picture/#:data.picture#\')"></span><span>#:data.text#</span>',
                    template:
                        '<span class="k-state-default" style="background-image: url(\'#:APP_URL#/storage/user-picture/#:data.picture#\')"></span>' +
                        '<span class="k-state-default"><h6>#: data.text #</h6><p>#: data.designation #(#: data.department #)</p><p>Job Location: #: data.job_title #</p></span>',
                    dataSource: {
                        type: "json",
                        serverFiltering: true,
                        transport: {
                            read: {
                                dataType: "json",
                                url: APP_URL + '/presentationEmployeeList',
                            }
                        },
                        serverPaging: false,
                    },
                    filtering: function (e) {
                        // alert(e.filter.value)
                        var filterValue = e.filter != undefined ? e.filter.value : "";
                        e.preventDefault();
                        //filter = 'Hello';
                        this.dataSource.filter({
                            logic: "or",
                            search: filterValue
                        });
                    },
                    height: 400,
                    select: onSelect
                }).data("kendoAutoComplete");
            });

        })
    </script>
@endsection
