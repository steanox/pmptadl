@extends('layout.app')

@section('content')
    <?php

    function checkRole($val,$key){
        $role = old('userRole');
        if($val == $role[$key]){
            echo "selected";
        }

    }
    ?>
    <link rel="stylesheet" href="https://cdn.rawgit.com/LeaVerou/awesomplete/gh-pages/awesomplete.css">

    <style>
        .awesomplete{
            display: block !important;
        }

    </style>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title">
                {{title_case($title[1])}} <small></small>
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
                <form role="form" method="POST" action="{{ route('storeUserDiscipline',$project) }}" onsubmit="return checkStatus()">

                    {{ csrf_field() }}
                    <div class="col-md-6 col-xs-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-green">
                                    <i class="icon-pin font-green"></i>
                                    <span class="caption-subject bold uppercase">Personal Information</span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control" name="disciplineName" value="{{old('disciplineName')}}">
                                <label for="form_control_1">Discipline Name</label>
                            </div>

                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control  select2me" name="initiatorName" data-placeholder="Select Initiator">
                                    <option value=""></option>
                                    @foreach ($userlist as $user)
                                        <option value="{{$user->id }}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <label for="form_control_1" style="top:-4px !important">Initiator</label>
                            </div>

                            <div class="form-group form-md-line-input form-md-floating-label">

                                <div class="form-group " id="user-list">
                                    @if(old('user'))
                                        @foreach(old('user') as $key=>$value)
                                            <div class="row new-user-form">
                                                <div class="col-md-8">
                                                    <input type="text" name="user[]" class="form-control assign-user" value="{{$value}}" />
                                                </div>
                                                <div class="col-md-4">

                                                    <select class="form-control userRoleClass" name="userRole[]">
                                                        <option value="0" <?php checkRole(0,$key)?> >- Role - </option>
                                                        <option value="1" <?php checkRole(1,$key)?> >Review</option>
                                                        <option value="2" <?php checkRole(2,$key)?> >Approve</option>
                                                    </select>

                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row new-user-form">
                                            <div class="col-md-8">
                                                <input type="text" name="user[]" class="form-control assign-user" />
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control userRoleClass" name="userRole[]">
                                                    <option value="0">- Role - </option>
                                                    <option value="1">Review</option>
                                                    <option value="2">Approve</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif



                                </div>
                                <a href="#" class="btn btn-xs green" id="add-new-form">+ Add new User</a>
                            </div>

                            <div class="form-actions noborder">
                                <input type="submit" class="btn blue"  value="submit"></input>
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

        function checkStatus() {

            var roleUser = document.getElementsByName("userRole[]");

            roleUser.forEach(function(value,key){
               if(roleUser[key].value == 0){
                   var user = document.getElementsByName("user[]");

                   alert("Please select user role for " + user[key].value);
                   event.preventDefault();
                   return false;
               }
            });

            return true;
        }

        var firstComponent
        $("#add-new-form").click(function(){

            var userForm = $('.new-user-form:first-child').clone();

            userForm.find("input").val('');
            $("#user-list").append(userForm);

            new Awesomplete(userForm.find("input")[0],{
                list: list,
                filter: function(text, input) {
                    return Awesomplete.FILTER_CONTAINS(text, input.match(/[^,]*$/)[0]);
                },

                item: function(text, input) {

                    return Awesomplete.ITEM(text, input.match(/[^,]*$/)[0]);
                },

                replace: function(text) {
                    var before = this.input.value.match(/^.+,\s*|/)[0];
                    this.input.value = before + text ;
                }
            });

        })
    </script>

    <script>
        var list
        setNameField()
        function setNameField(){
            var data = [];
            window.addEventListener("awesomplete-selectcomplete",function(data){
                console.log(data)
            });
            var ajax = new XMLHttpRequest();
            ajax.open("GET", window.location.origin+"/ajax/getAllUser", true);
            ajax.onload = function() {
                 list = JSON.parse(ajax.responseText).map(function(i) {
                    // var obj = {
                    // 	label: i.name,
                    // 	value: i.id
                    // };
                    return i.name;
                });

                new Awesomplete(".assign-user",{
                    list: list,
                    filter: function(text, input) {
                        return Awesomplete.FILTER_CONTAINS(text, input.match(/[^,]*$/)[0]);
                    },

                    item: function(text, input) {

                        return Awesomplete.ITEM(text, input.match(/[^,]*$/)[0]);
                    },

                    replace: function(text) {
                        var before = this.input.value.match(/^.+,\s*|/)[0];
                        this.input.value = before + text ;
                    }
                });
            };
            ajax.send();

        }
    </script>
@endsection