@extends('layout.app')

@section('content')
    <?php

    function checkDiscipline($val, $key)
    {

        if ($val == $key) {
            echo "selected";
        }

    }
    ?>
    <style>
        .user-preview{

            -webkit-appearance: none;
            -moz-appearance: none;
            text-indent: 1px;
            text-overflow: '';

        }

        .datepicker{
            cursor:grab !important;
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
                <div class="col-md-6 col-xs-12">

                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-green">
                                <i class="icon-pin font-green"></i>
                                <span class="caption-subject bold uppercase">Upload new document</span>

                            </div>
                        </div>
                        <form action="{{route("storeNewDocument",$projectName)}}" method="POST"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group form-md-line-input ">
                                <input class="form-control" id="documentFile" type="file" name="documentFile">

                                <div id="progress">
                                    <div class="bar" style="width: 0%;"></div>
                                </div>
                                <label for="File">Your file will be renamed to {{$firstFileName}}</label>
                            </div>

                            <div class="form-group ">
                                <span class="caption-subject bold uppercase">Deadline</span>
                                <input type="text" name="deadline" class="form-control datepicker" placeholder="Pick Your Deadline" readonly value="{{old('deadline')}}">

                            </div>

                            <input type="hidden" name="disciplineID"value="{{$disciplineID}}">
                            <input type="hidden" name="firstFileName" value="{{$firstFileName}}">

                            <div class="form-group form-md-line-input ">
                                <span class="caption-subject bold uppercase">Comment</span>
                                <textarea style="width:100%" rows="3" name="comment">{{old("comment")}}</textarea>
                            </div>

                            <div class="form-group">
                                <span class="caption-subject bold uppercase">Next status</span>
                                <select name="status" class="form-control" id="nextStatus" onchange="changeUserDropdown()">
                                    <option value="Review" <?php if(old("status") == "Review" ) echo "selected";?> >Review</option>
                                    <option value="Approve" <?php if(old("status") == "Approve" ) echo "selected";?>>Approve</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <span class="caption-subject bold uppercase">Next assigner</span>
                                <div>
                                    {{--<input type="text" class="form-control" placeholder="" />--}}
                                    <select name="" id="userListSelect" class="form-control" style="width:70%">
                                        <option value="0">- Select User -</option>
                                        @foreach($userList as $user)
                                            <option value="{{$loop->iteration}}"
                                                    data-role="{{$user["role"]}}">{{$user["name"]}}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn blue" style="right: 35;position: absolute;top: 444px;"
                                            onclick="assignNewUser()">+ Assign User
                                    </button>
                                </div>

                            </div>
                            &nbsp
                            <div class="form-group form-md-line-input " id="assigned-user-list">
                                @if(old('users'))
                                    @foreach(old("users") as $key=>$value)
                                        <div class="row new-user-form">
                                            <div class="col-md-8">

                                                <input type="text" name="users[]" class="form-control"
                                                       value="{{$value}}" readonly="true">
                                                <button style="background-color: #e6e6e6;border: none;position: absolute;top: 10px;right: 14px;"
                                                        onclick="deleteNode(this)">X
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="userRole[]" class="form-control" readonly="true">
                                                    <option value="{{$userList[$key]["role"]}}">{{$userList[$key]["role"]}}</option>
                                                </select></div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            &nbsp

                            <div class="form-actions noborder">
                                <button type="submit" class="btn blue" onclick="return checkForm()">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('addjs')
    <script>
        $( function() {
            $( ".datepicker" ).datepicker();
        } );
    </script>

    <script>


        var assignedUsers = [];

        function assignNewUser() {

            event.preventDefault();

            if($('#userListSelect').is(":empty")){
                alert("Please pick another role");
                return false;
            }
            var user = $('#userListSelect').find(":selected");
            var name = user.text();
            var assignedUserComponent = "";

            console.log(name);
            console.log(assignedUsers);

            if (user.val() != 0 && !assignedUsers.includes(name)) {
                assignedUsers.push(user.text());
                var userRole = user.attr("data-role");

                assignedUserComponent += '<div class="row new-user-form">';
                assignedUserComponent += '<div class="col-md-8">';
                assignedUserComponent += '<input type="text" name="users[]" class="form-control" value="' + name + '" readonly="true"/>';
                assignedUserComponent += '<button type="button" id="delButton" data-name="'+ name +'" onclick="deleteNode(this)" style="background-color: #e6e6e6;border: none;position: absolute;top: 10px;right: 14px;">X</button>';
                assignedUserComponent += '</div>';
                assignedUserComponent += '<div class="col-md-4">';
                assignedUserComponent += '<select class="form-control user-preview" name="userRole[]" readonly="true"><option value="' + userRole + '">' + userRole + '</option></select>';
                assignedUserComponent += '</div>';
                assignedUserComponent += '</div>';

                $('#assigned-user-list').append(assignedUserComponent);

            } else {
                alert('please assign another user');

            }

        }

        function changeUserDropdown(){

            var selectedRole = $('#nextStatus option:selected').val();
            $('#userListSelect').empty();



            <?php foreach ($userList as $user){ ?>

                var userRole = '{{$user["role"]}}';


                if(userRole == selectedRole){
                    var option = '<option value="{{$user["name"]}}" data-role="{{$user["role"]}}">{{$user["name"]}}</option>';
                    $('#userListSelect').append(option);
                }

            <?php }?>

            if($('#userListSelect').is(":empty")){
                alert("No one is assigned to this role");
            }

        }

        function checkForm() {
            if (document.getElementById("documentFile").files.length == 0) {
                alert("Please insert file");
                event.preventDefault();
                return false;
            }
            return true;
        }

        function deleteNode(param) {
            var removedName = $(param).data("name");



            remove(assignedUsers,removedName);
            $(param).parent().parent().remove();
            event.preventDefault();

        }

        function remove(array, element) {
            const index = array.indexOf(element);
            array.splice(index, 1);
        }

        changeUserDropdown()


    </script>
@endsection