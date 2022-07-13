<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajax_crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div id="save_form_success"></div>
                <div class="card shadow p-5">
                    <div class="card-header">
                        <h1 class="float-start">Add all new student</h1>
                        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new</button>
                    </div>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <ul id="save_form_data"></ul>
                <div class="form-group mb-3">
                    <label for="text">Enter your name</label>
                    <input type="text" class="name form-control" id="" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="text">Enter your email</label>
                    <input type="text" class="email form-control" id="" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="text">Enter your phone</label>
                    <input type="text" class="phone form-control" id="" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="text">Enter your course</label>
                    <input type="text" class="course form-control" id="" placeholder="Enter your name">
                </div>
                
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="add_student btn btn-primary">Send</button>
        </div>
      </div>
    </div>
  </div>


  {{-- edit_modal --}}

  <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <ul id="save_form_data1"></ul>
                <div class="form-group mb-3">
                    <label for="text">Enter your name</label>
                    <input type="text" class="edit_name form-control" id="" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="text">Enter your email</label>
                    <input type="text" class="edit_email form-control" id="" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="text">Enter your phone</label>
                    <input type="text" class="edit_phone form-control" id="" placeholder="Enter your name">
                </div>
                <input type="hidden" class="edit_id">
                <div class="form-group mb-3">
                    <label for="text">Enter your course</label>
                    <input type="text" class="edit_course form-control" id="" placeholder="Enter your name">
                </div>
                
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="update_student btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>


   {{-- delete_modal --}}

   <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
            <h4>Are you sure want to delete it?</h4>    
          <input type="hidden" class="delete_id">                    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="delete_student btn btn-primary">Yes Delete</button>
        </div>
      </div>
    </div>
  </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            readData();
            
            $(document).on('click','.add_student',function(e){
                e.preventDefault();
                var data = {
                 'name': $('.name').val(),
                 'email' : $('.email').val(),
                 'phone' : $('.phone').val(),
                 'course': $('.course').val(),
                }
                // console.log(data);
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    data:data,
                    url:'add/student',
                    success : function(responsive){
                        if(responsive.status == 400){

                            $('#save_form_data').html("");
                            $('#save_form_data').addClass('alert alert-danger');

                            $.each(responsive.errors,function(key,data_errors){
                                $('#save_form_data').append('<li>'+data_errors+'</li>');
                            });
                        }else{

                            $('#save_form_data').html("");
                            $('#save_form_success').addClass('alert alert-success');
                            $('#save_form_success').text(responsive.message);
                            $('#exampleModal').modal('hide');
                            $('#exampleModal').find('input').val("");
                            readData();
                        }
                    }

                })
            })







           function readData(){
                $.ajax({
                    type :"get",
                    dataType :'json',
                    url :'ajax/getdata',
                    success : function(response){
                        $('tbody').html("")
                        $.each(response.data,function(key,item){
                            key = key + 1;
                            $('tbody').append('<tr>\
                                    <td>'+key+'</td>\
                                    <td>'+item.name+'</td>\
                                    <td>'+item.email+'</td>\
                                    <td>'+item.phone+'</td>\
                                    <td>'+item.course+'</td>\
                                    <td><button value="'+item.id+'" class="edit_btn btn btn-info">Edit</button> || <button value="'+item.id+'" class="delete_btn btn btn-danger">Delete</button>\
                                    </td>\
                                </tr>');
                        });
                    }

           });
                

            }

            $(document).on('click','.edit_btn',function(e){
                e.preventDefault();
                var edit_id = $(this).val();
                // console.log(edit_id);
                $('#edit_modal').modal('show');
                $.ajax({
                    type:'get',
                    dataType:'json',
                    url:'edit/data/'+edit_id,
                    success:function(response){
                        if(response.status == 400){
                            $('#save_form_data1').html("");
                            $('#save_form_success').addClass('alert alert-success');
                            $('#save_form_success').text(responsive.message);
                        }else{
                            $('.edit_name').val(response.student.name);
                            $('.edit_email').val(response.student.email);
                            $('.edit_phone').val(response.student.phone);
                            $('.edit_course').val(response.student.course);
                            $('.edit_id').val(response.student.id);
                        }
                    }

                })
            });
            
            $(document).on('click','.delete_btn',function(e){
                e.preventDefault();
                
                var del_id = $(this).val();
                $('.delete_id').val(del_id);
                $('#delete_modal').modal('show');
            });


            $(document).on('click','.delete_student',function(e){
                e.preventDefault();

                var del_id = $('.delete_id').val();


                $('.delete_id').val(del_id);
                //$('#delete_modal').modal('show');

                $.ajax({
                    type:'DELETE',
                    url:'delete/data/'+del_id,
                    success:function(response){
                        $('#save_form_success').html('');
                        $('#save_form_success').text(response.message);
                        $('#save_form_success').addClass('alert alert-success');
                        $('#delete_modal').modal('hide');
                        readData();
                    }
                })
            });
















            $(document).on('click','.update_student',function(e){
                e.preventDefault();
                
                var std_id = $('.edit_id').val();
                $(this).html('Updating');
                var data = {
                 'name': $('.edit_name').val(),
                 'email' : $('.edit_email').val(),
                 'phone' : $('.edit_phone').val(),
                 'course': $('.edit_course').val(),
                }
                $.ajax({
                    type:'PUT',
                    dataType:'json',
                    data:data,
                    url:'update/student/'+std_id,
                    success : function(responsive){
                        if(responsive.status == 400){

                            $('#save_form_data1').html("");
                            $('#save_form_data1').addClass('alert alert-danger');
                            $('.update_student').html('update');
                            $.each(responsive.errors,function(key,data_errors){
                                $('#save_form_data1').append('<li>'+data_errors+'</li>');
                            });
                        }else if(responsive.status == 404){
                            
                            $('#save_form_data1').html("");
                            $('#save_form_success').addClass('alert alert-success');
                            $('#save_form_success').text(responsive.message);
                            $('.update_student').html('update');
                            readData();
                        }else{
                            $('#save_form_data1').html("");
                            $('#save_form_success').html("");
                            $('#save_form_success').addClass('alert alert-success');
                            $('#save_form_success').text(responsive.message);
                            $('#edit_modal').modal('hide');
                            $('.update_student').html('update');
                            readData();
                           
                        }
                    }

                })
            })
            

            
        });
       

    </script>
</body>
</html>