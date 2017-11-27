@extends('layout.app')

@section('content')
    <?php

    function checkRole($val, $key)
    {
        $role = old('userRole');
        if ($val == $role[$key]) {
            echo "selected";
        }

    }
    ?>
    <link rel="stylesheet" href="https://cdn.rawgit.com/LeaVerou/awesomplete/gh-pages/awesomplete.css">

    <style>
        .awesomplete {
            display: block !important;
        }

    </style>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title">
                {{title_case($title[1])}}
                <small></small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{url("/")}}">Home</a>
                    </li>
                    @foreach ($title as $title)
                        <li>
                            <i class="fa fa-angle-right"></i>
                            <a href="">{{title_case($title)}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <form role="form" method="POST" action="{{ route('storeUserDiscipline',$project) }}"
                      onsubmit="return checkStatus()">

                    {{ csrf_field() }}
                    <div class="col-md-6 col-xs-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-green">
                                    <i class="icon-pin font-green"></i>
                                    <span class="caption-subject bold uppercase">Personal Information</span>
                                </div>
                            </div>
                            <div class="row" style="padding:20px 20px" id="form_section">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <h4><b>Discipline Name</b></h4>
                                    {{--<input type="text" class="form-control" name="disciplineName"--}}
                                    {{--value="{{old('disciplineName')}}">--}}
                                    <select name="disciplineName" id="disciplineName" class="form-control"
                                            onchange="checkButtonStatus()">
                                        <option value="0">- Select Discipline -</option>
                                        <option value="Design">Design</option>
                                        <option value="Architect">Architect</option>
                                    </select>

                                </div>
                                <br>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <h4><b>Initiator</b></h4>
                                    <div class="col-md-6">
                                        <select id="initiatorOrganization" name="initiatoOrganization"
                                                class="form-control" onchange="checkButtonStatus()">
                                            <option value="">- Select Organization -</option>
                                            @foreach($organizations as $organization)
                                                <option value="{{$organization->id}}"
                                                <?php  if (old('initiatoOrganization')) {
                                                    if (old('initiatoOrganization') == $organization->id) echo 'selected';
                                                }
                                                    ?>
                                                >{{$organization->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <i class="fa fa-spinner fa-spin fa-3x fa-fw" id="initiatorSpinner" style="font-size: 16px;
                                                                                                                position: absolute;
                                                                                                                top: 10px;"></i>
                                        <select class="form-control" name="initiatorName" id="initiatorName"
                                                data-placeholder="Select Initiator">
                                            <option value="0"> --</option>

                                        </select>
                                    </div>


                                </div>

                                <br>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <h4><b>Assign User</b></h4>

                                    <div class="form-group " id="user-list">
                                        @if(old('user'))
                                            @foreach(old('user') as $key=>$value)
                                                <div class="row new-user-form">
                                                    <div class="col-md-8">
                                                        <input type="text" name="user[]"
                                                               class="form-control assign-user"
                                                               value="{{$value}}"/>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <select class="form-control userRoleClass" name="userRole[]">
                                                            <option value="0" <?php checkRole(0, $key)?> >- Role -
                                                            </option>
                                                            <option value="1" <?php checkRole(1, $key)?> >Review
                                                            </option>
                                                            <option value="2" <?php checkRole(2, $key)?> >Approve
                                                            </option>
                                                        </select>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row new-user-form" data-index="1">
                                                <div class="col-md-4">
                                                    <select name="initiatoOrganization"
                                                            class="form-control organizationUser"
                                                            onchange="setUser(this)">
                                                        <option value="">- Select Organization -</option>
                                                        @foreach($organizations as $organization)
                                                            <option value="{{$organization->id}}">{{$organization->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <i class="fa fa-spinner fa-spin fa-3x fa-fw" id="initiatorSpinner"
                                                       style="font-size: 16px;
                                                                                                                position: absolute;
                                                                                                                top: 10px;
                                                                                                                display:none;"></i>
                                                    <select name="user[]" id="" class="form-control user-form">
                                                        <option value="0">- Please assign a user -</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control userRoleClass" name="userRole[]"
                                                            onchange="checkButtonStatus()">
                                                        <option value="0">- Role -</option>
                                                        <option value="1">Review</option>
                                                        <option value="2">Approve</option>
                                                    </select>

                                                </div>
                                                <br>
                                            </div>
                                        @endif


                                    </div>
                                    <a href="#" class="btn btn-xs green" id="add-new-form">+ Add new User</a>
                                </div>

                                <button type="button" class="btn blue" id="reviewButton" onclick="showReview()"
                                        disabled>Review
                                </button>
                            </div>


                            <div class="row" style="padding:20px 20px;display: none" id="review_section">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Submit</th>
                                        <th>Reviewer</th>
                                        <th>Approval</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <ul class="list-group" id="submitter">
                                                <li class="list-group-item">First item</li>
                                                <li class="list-group-item">Second item</li>
                                                <li class="list-group-item">Third item</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group" id="reviewer">
                                                <li class="list-group-item">First item</li>
                                                <li class="list-group-item">Second item</li>
                                                <li class="list-group-item">Third item</li>

                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group" id="approval">
                                                <li class="list-group-item">First item</li>
                                                <li class="list-group-item">Second item</li>
                                                <li class="list-group-item">Third item</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>

                                <button type="button" class="btn red" onclick="backToForm()">Back</button>
                                <input type="submit" class="btn blue" value="submit" id="submitButton"></input>

                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('addjs')
    <script src="https://cdn.rawgit.com/LeaVerou/awesomplete/gh-pages/awesomplete.min.js"></script>
    <script>
        ComponentsDropdowns.init();
    </script>

    <script>
        var index = 1;

        function checkStatus() {

            var roleUser = document.getElementsByName("userRole[]");

            roleUser.forEach(function (value, key) {
                if (roleUser[key].value == 0) {
                    var user = document.getElementsByName("user[]");

                    alert("Please select user role for " + user[key].value);
                    event.preventDefault();
                    return false;
                }
            });

            return true;
        }

        $("#add-new-form").click(function () {

            formTotal++;


            var userForm = $('.new-user-form:first-child').clone();

            userForm.find('select.user-form').empty();
            var option = '<option value="0">- Please assign a user - </option>';
            userForm.find('select.user-form').append(option);


            index++;
            userForm.attr('data-index', index);
            userForm.find("input").val('');
            $("#user-list").append(userForm);
            checkButtonStatus()
//            new Awesomplete(userForm.find("input")[0], {
//                list: list,
//                filter: function (text, input) {
//                    return Awesomplete.FILTER_CONTAINS(text, input.match(/[^,]*$/)[0]);
//                },
//
//                item: function (text, input) {
//
//                    return Awesomplete.ITEM(text, input.match(/[^,]*$/)[0]);
//                },
//
//                replace: function (text) {
//                    var before = this.input.value.match(/^.+,\s*|/)[0];
//                    this.input.value = before + text;
//                }
//            });


        })
    </script>

    <script>
        var list
        setNameField()

        function setNameField() {
            var data = [];
            window.addEventListener("awesomplete-selectcomplete", function (data) {

            });
            var ajax = new XMLHttpRequest();
            ajax.open("GET", window.location.origin + "/ajax/getAllUser", true);
            ajax.onload = function () {
                list = JSON.parse(ajax.responseText).map(function (i) {
                    return i.name;
                });

                new Awesomplete(".assign-user", {
                    list: list,
                    filter: function (text, input) {
                        return Awesomplete.FILTER_CONTAINS(text, input.match(/[^,]*$/)[0]);
                    },

                    item: function (text, input) {

                        return Awesomplete.ITEM(text, input.match(/[^,]*$/)[0]);
                    },

                    replace: function (text) {
                        var before = this.input.value.match(/^.+,\s*|/)[0];
                        this.input.value = before + text;
                    }
                });
            };
            ajax.send();

        }


        function setInitiatorName(val, callback) {
            $('#reviewButton').prop('disabled', true);
            $.ajax({
                url: window.location.origin + "/ajax/getUserFromOrganization/" + val,
                dataType: 'json',
                type: 'GET',
                success: function (values) {
                    totalURLLoad--;

                    checkButtonStatus()

                    callback(values);
                }
            })
        }

        $('#initiatorOrganization').on('change', function () {
            $('#initiatorSpinner').show();
            $('#initiatorName').empty();
            totalURLLoad++;
            setInitiatorName(this.value, function (values) {

                $('#initiatorSpinner').hide();

                $.each(values, function (id, val) {
                    var option = $("<option>", {
                        value: val.id
                    }).html(val.name);

                    $('#initiatorName').append(option);
                });


            });
        });


        function setUser(elm) {
            var index = $(elm).parent().parent().data('index');
            var value = elm.value;
            totalURLLoad++;


            $('.new-user-form[data-index="' + index + '"] select.user-form').empty();
            $('.new-user-form[data-index="' + index + '"] i').show();
            setInitiatorName(value, function (values) {

                $.each(values, function (id, val) {
                    var option = $("<option>", {
                        value: val.name
                    }).html(val.name);
                    $('.new-user-form[data-index="' + index + '"] i').hide();
                    $('.new-user-form[data-index="' + index + '"] select.user-form').append(option)

                });


            });


        }

        $('#initiatorSpinner').hide();

        function showReview() {

            event.preventDefault();


            var user = document.getElementsByName("user[]");


            var approvalStatus = document.getElementsByName("userRole[]");

            var submitter = $('#initiatorName').find(":selected").text();



            $('#reviewer').empty();
            $('#approval').empty();
            $('#submitter').empty();

            var submitterList = $("<li>", {
                class: 'list-group-item'
            }).html(submitter);

            $('#submitter').append(submitterList);

            user.forEach(function (val, key) {
                var selectedName = val.options[val.selectedIndex].text;
                var selectedRole = approvalStatus[key].value

                var list = $("<li>", {
                    class: 'list-group-item'
                }).html(selectedName);


                if (selectedRole == 1) {
                    $('#reviewer').append(list);
                }

                if (selectedRole == 2) {
                    $('#approval').append(list);
                }

            })

            $('#review_section').show();
            $('#form_section').hide();


        }


        function backToForm() {
            event.preventDefault();
            $('#review_section').hide();
            $('#form_section').show();
        }

        function checkUserRole() {
            var roleUser = document.getElementsByName("userRole[]");
            var roleStatus = true
            roleUser.forEach(function (value, key) {
                if (roleUser[key].value == 0) {
                    var user = document.getElementsByName("user[]");

                    $('#reviewButton').prop('disabled', true);
                    roleStatus = false;
                }
            });

            return roleStatus;
        }

        function checkDisciplineName() {
            console.log($('#disciplineName').val());
            if ($('#disciplineName').val() == 0) {

                return false;
            }

            return true;
        }

        function checkInitiatorName() {
            console.log($('#initiatorName').val());
            if ($('#initiatorName').val() == 0) {


                return false
            }

            return true
        }

        function checkUserTotal() {
            var roleUser = document.getElementsByName("user[]");
            var roleStatus = true;
            roleUser.forEach(function (value, key) {
                console.log('check user total:' + roleUser[key].value);
                if (roleUser[key].value == 0) {
                    var user = document.getElementsByName("user[]");
                    roleStatus = false
                }
            });


            return roleStatus;
        }


        var formTotal = 1;
        var totalURLLoad = 0;

        function checkButtonStatus() {

            if(checkDisciplineName() && checkInitiatorName() && checkUserTotal() && checkUserRole() && totalURLLoad == 0){
                $('#reviewButton').prop('disabled', false);
            }else{

                $('#reviewButton').prop('disabled', true);
            }


        }


    </script>
@endsection