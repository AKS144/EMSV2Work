@csrf
<script>
$(document).ready(function() {

    var _token = $('input[name="_token"]').val();
    
    var  is_onlineUser = $('#is_onlineUser').val();

        if (is_onlineUser == 1) {
            $('#online_back').text('You are now Online').removeClass('Offline').addClass('Online')
        }else{
            $('#online_back').text('You are Offline, go back online').removeClass('Online').addClass('Offline')
        }

        // alert(1)
    fetch_user();
    update_chat_history_data();

    function fetch_team_users() {

        // var id = $("input[name=current_user]").val();
        var id = $('#team').val();
        // alert(id)
        var url = "{{ route('chat.show', ":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            method: "Get",
            success: function(data) {
                $('#employee_details').html(data);
            }
        })
    }

    // ===========================

    fetch_user();
    fetch_user();
    fetch_team_users()
    update_chat_history_data();

    setInterval(function() {
        update_last_activity();
        fetch_user();
        update_chat_history_data();
        fetch_group_chat_history();
        fetch_projectmanager_group_chat_history();
        update_projectmanager_group_chat_history_data();

   
       
        // update_is_online();
        // load();
    }, 5000);

    function fetch_user() {

        var id = $('#team').val();
            // alert(id)
        $.ajax({
            url: "{{route('chat.index')}}",
            method: "get",
            data: {
                id:id
            },

            success: function(data) {
                $('#employee_details').html(data);
            }
        })
    }

    function update_last_activity() {

        var id = $("input[name=current_user]").val();
        var url = "{{ route('chat.update', ":id") }}";
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            method:"Put",
            data:{id:id, _token:_token},
            success: function(data) {

            }
        })
    }

    // Chat Dialog Box 

    function make_chat_dialog_box(to_user_id, to_user_name, to_team_id, team_name) {
        var modal_content = '<div id="user_dialog_' + to_user_id +
            '" class="user_dialog " title=" '+to_user_name+' --- ' + team_name + '" >';
           
        modal_content +=
            '<div style="height:350px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' +
            to_user_id + '" id="chat_history_' + to_user_id + '">';
            
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
     

        modal_content += '  <div id="form-element"></div>';

        modal_content += '  <input type="hidden" name="team_id" id="team_id" value="'+to_team_id+'">';

        modal_content += '<textarea name="chat_message_' + to_user_id + ' ' + to_team_id + '" id="chat_message_' + to_user_id +
            '" class="form-control chat_message" ></textarea>';
    
        modal_content += '</div><div class="form-group" align="right">';
        modal_content += '<button type="button" name="send_chat" id="' + to_user_id +
            '" class="btn btn-round btn-info send_chat"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button></div></div>';
        
            // alert(modal_content)
        $('#user_model_details').html(modal_content);
    }
 
   

    $(document).on('click', '.start_chat', function() {
        // alert(1)
        var to_user_id = $(this).data('touserid');
        
        var to_user_name = $(this).data('tousername');

        var to_team_id = $(this).data('toteamid');

        var team_name = $(this).data('toteamname');

        var id = $("input[name=current_user]").val();

        update_Read_messages(to_user_id);
       
        // $('#team_id').val(to_team_id);

        $('.chat-with').text(to_user_name);
        // alert(to_user_name)
        make_chat_dialog_box(to_user_id, to_user_name, to_team_id, team_name);
        $("#user_dialog_" + to_user_id).dialog({
            dialogClass: 'custom-ui-widget-header-accessible',
            // width: 'auto',
            width: 750,
             minWidth: 700,
             minHeight: 280,
             autoOpen: false,
             responsive: true,
             fluid: true, 
             width: $(window).width() > 500 ? 450 : 300,
             position: {
               my: 'center',
               at: 'left+920, top+400', 
             }
           
        });
        // $('#form-element').html("<form action=''id='a-form-element' name='myDropZone' class='dropzone'></form>");

        if ($('#user_dialog_' + to_user_id).dialog("isOpen") === true) {
            
               $('#user_dialog_' + to_user_id).dialog("close");
             } else {
               $('#user_dialog_' + to_user_id).dialog("open").prev().css('background', '#4B5F71').css('color', '#eee');
               $('#chat_message_' + to_user_id).emojioneArea({
                    pickPosition: "top",
                    toneStyle: "bullet",
                });
             }

        // $('#user_dialog_' + to_user_id).dialog('open').prev().css('background', '#D9534F').css('color', '#eee');
       
    });

    

    function update_is_online() {
            var id = $("input[name=current_user]").val();
            var url = "{{ route('Online_Status', ":id") }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method:"Put",
                data:{id:id, _token:_token},
                success: function(data) {

        }
    })
    }

    function update_is_offline() {
            var id = $("input[name=current_user]").val();
            var url = "{{ route('Offline_Status', ":id") }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method:"Put",
                data:{id:id, _token:_token},
                success: function(data) {

                }
            })
    }

    
    function update_Read_messages(to_user_id) {
    
    var id = $("input[name=current_user]").val();
    var url = "{{ route('read_message', ":id") }}";
    url = url.replace(':id', id);
        // alert(to_user_id);
    $.ajax({
        url: url,
        method:"Put",
        data:{id:id, to_user_id:to_user_id, _token:_token},
        success: function(data) {
            sound();

        }
    })
    }


    var time = new Date().getTime();
    // alert(time);
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 60000) 
         {
           var  offline = update_is_offline();

            $('#online_back').text('You are Offline, go back online').removeClass('Online').addClass('Offline')
         }

         else {
            setTimeout(refresh, 10000);
         }
                   
            //  update_is_offline();
     }

     setTimeout(refresh, 10000);

    //  $('#online_back').on('click', function(){
    $(document).on('click', '#online_back', function() {
        update_is_online();
        $('#online_back').text('You are now Online').removeClass('Offline').addClass('Online')
     })



    $(document).on('click', '.send_chat', function() {
        // var audio = $('#message_sound');

        var to_user_id = $(this).attr('id');
        var to_team_id = $('#team_id').val();
       
        var chat_message = $('#chat_message_' + to_user_id).val();

        $.ajax({
            url: "{{route('chat.store')}}",
            method: "POST",
            data: {
                to_user_id: to_user_id,
                to_team_id: to_team_id,
                chat_message: chat_message,
                _token: _token
            },
            success: function(data) {

                // if(data.sound == yes){
                //     jQuery('#message_sound')[0].play();
                // }
                   
                // $('#chat_message_' + to_user_id).val('');
                var element = $('#chat_message_'+to_user_id).emojioneArea();
                element[0].emojioneArea.setText('');
                $('#chat_history_' + to_user_id).html(data);
            }
        })
    });


    function fetch_employee_chat_history(to_user_id)
    {

        $.ajax({
        url:"fetch_employee_chat_history",
        method:"get",
        data:{to_user_id:to_user_id},
        success:function(data){
            $('#chat_history_'+to_user_id).html(data);
            // $('#show-chat-history').html(data);
        }
        })
    }

    function update_chat_history_data()
    {
        $('.chat_history').each(function(){
        var to_user_id = $(this).data('touserid');
        fetch_employee_chat_history(to_user_id);
        update_Read_messages(to_user_id);
        });
    }

        $(document).on('click', '.ui-button-icon', function(){
        $('.user_dialog').dialog('destroy').remove();
        $('#is_active_group_chat_window').val('no');
        });


            $(document).on('focus', '.chat_message', function(){
                        var is_typing = 'yes';
                        var id = $("input[name=current_user]").val();
                        var url = "{{ route('Update_is_Typing', ":id") }}";
                        url = url.replace(':id', id);

                    $.ajax({
                        url: url,
                        method:"put",
                        data:{is_typing:is_typing, _token:_token},
                        success: function(data) {
                            console.log(data);
                        }
                    })
                });

            $(document).on('blur', '.chat_message', function(){

                var is_typing = 'no';
                var id = $("input[name=current_user]").val();
                var url = "{{ route('Update_is_Typing', ":id") }}";
                url = url.replace(':id', id);

        $.ajax({
            url: url,
            method:"put",
            data:{is_typing:is_typing,  _token:_token},
            success: function(data) {
                    console.log(data);
            }
        })
    })

    $('#delete_chat').on('show.bs.modal', function(e) {
            var chat_id = $(e.relatedTarget).data('chat-id');
            $(e.currentTarget).find('input[name="chat_id"]').val(chat_id);
    });

   
    $(document).on('click', '#remove_chat', function(){
        var chat_id = $("input[name=chat_id]").val();
        var url = "{{ route('Delete_Chat', ":chat_id") }}";
        url = url.replace(':chat_id', chat_id);

        $.ajax({
            url:url,
            method:"delete",
            data:{chat_id:chat_id, _token:_token},
            success:function(data)
            {
            update_chat_history_data();
            $('#delete_chat').modal('hide');
            }
        })

        });

    // GROUP CHAT SCRIPS START HERE
    var team_id = $(this).data('team');

    $('#group_chat_dialog').dialog({
        dialogClass: 'custom-ui-widget-header-accessible',
            // width: 750,
             width: 'auto',
             minWidth: 700,
             minHeight: 280,
             autoOpen: false,
             responsive: true,
             fluid: true, 
             width: $(window).width() > 500 ? 450 : 300,
             position: {
               my: 'center',
               at: 'left+920, top+400', 
             }
    });


// Demo: http://codepen.io/jasonday/pen/amlqz
// movemaine@gmail.com

$("#content").dialog({
    width: 'auto', // overcomes width:'auto' and maxWidth bug
    maxWidth: 600,
    height: 'auto',
    modal: true,
    fluid: true, //new option
    resizable: false
});


// on window resize run function
$(window).resize(function () {
    fluidDialog();
});

// catch dialog if opened within a viewport smaller than the dialog width
$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
    fluidDialog();
});

function fluidDialog() {
    var $visible = $(".ui-dialog:visible");
    // each open dialog
    $visible.each(function () {
        var $this = $(this);
        var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
        // if fluid option == true
        if (dialog.options.fluid) {
            var wWidth = $(window).width();
            // check window width against dialog width
            if (wWidth < (parseInt(dialog.options.maxWidth) + 50))  {
                // keep dialog from filling entire screen
                $this.css("max-width", "90%");
            } else {
                // fix maxWidth bug
                $this.css("max-width", dialog.options.maxWidth + "px");
            }
            //reposition dialog
            dialog.option("position", dialog.options.position);
        }
    });

}

    

    // if ($('#group_chat_dialog').dialog("isOpen") === true) {
            
    //         $('#group_chat_dialog').dialog("close");
    //       } else {
    //         $('group_chat_dialog').dialog("open").prev().css('background', '#4B5F71').css('color', '#eee');
    //         $('#is_active_group_chat_window').val('yes');
    //         fetch_group_chat_history();
    //         $('#group_chat_message').emojioneArea({
    //              pickPosition: "top",
    //              toneStyle: "bullet",
    //          });
    //       }

//    TEAM MEMBERS GROUP CHAT BUTTON STRAT HERE

    $('#group_chat').click(function(){

        var to_team_id = $('#group_team_id').val();

        // alert(to_team_id);

        if ($('#group_chat_dialog').dialog("isOpen") === true) {
            $('#group_chat_dialog').dialog("close");
        }else{
            $('#group_chat_dialog').dialog('open').prev().css('background', '#4B5F71').css('color', '#eee');
            $('#is_active_group_chat_window').val('yes');
            fetch_group_chat_history();
            $('#group_chat_message').emojioneArea({
            pickPosition: "top",
            toneStyle: "bullet",
           
        });
        }
    
    });



    $('#send_group_chat').click(function(){
    var chat_message = $('#group_chat_message').html();
    var to_team_id = $('#group_team_id').val();
    // alert(to_team_id);
    var action = 'insert_data';
    if(chat_message != '')
    {
    $.ajax({
        url:"{{route('group_chat_store')}}",
        method:"POST",
        data:{chat_message:chat_message, to_team_id:to_team_id,  _token:_token},
        success:function(data){
        $('#group_chat_message').html('');
        var element = $('#group_chat_message').emojioneArea();
                element[0].emojioneArea.setText('');
                $('#group_chat_history').html(data);
        // $('#projectmanager_group_chat_history_'+to_team_id).html(data);
            }
        })
    }
});



    function fetch_group_chat_history()
    {
    var group_chat_dialog_active = $('#is_active_group_chat_window').val();
    var to_team_id = $('#group_team_id').val();
    // alert(to_team_id);
    var action = "fetch_data";
    if(group_chat_dialog_active == 'yes')
    {
    $.ajax({
        url:"{{route('fetch_groupchat_history')}}",
        method:"GET",
        data:{action:action, to_team_id:to_team_id },
        success:function(data)
        {
        $('#group_chat_history').html(data);
        // $('#group_chat_history').html(data);
        }
    })
    }
    }


    Dropzone.options.dropzone =
     {
        maxFilesize: 10,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function(file) {
        //   setTimeout(() => {
            this.removeFile(file); // right here after 3 seconds you can clear
        //   }, 3000);
        },
        // removedfile: function(file)
        // {
        //     var name = file.upload.filename;
        //     $.ajax({
        //         headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //                 },
        //         type: 'POST',
        //         url: '{{ route("chat_file_delete") }}',
        //         data: {filename: name, _token:_token},
        //         success: function (data){
        //             console.log("File has been successfully removed!!");
        //         },
        //         error: function(e) {
        //             console.log(e);
        //         }});
        //         var fileRef;
        //         return (fileRef = file.previewElement) != null ?
        //         fileRef.parentNode.removeChild(file.previewElement) : void 0;
        // },
        // success: function(file, response)
        // {
        //     console.log(response);
        // },
        // error: function(file, response)
        // {
        //    return false;
        // }
    };


    function make_group_chat_dialog_box(to_team_id, to_team_name) {
        var modal_content = '<div id="projectmanager_group_chat_dialog_' + to_team_id +
            '" class="projectmanager_group_chat_dialog_ " title=" Group Chat  with ' + to_team_name + '" >';
           
        modal_content +=
            '<div style="height:350px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="projectmanager_group_chat_history" data-teamid="' +
            to_team_id + '" id="projectmanager_group_chat_history_' + to_team_id + '">';
            
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
     

        modal_content += '  <div id="form-element"></div>';

        modal_content += '  <input type="hidden" name="team_id" id="team_id" value="'+to_team_id+'">';

        modal_content += '<textarea name="projectmanager_group_chat_message_' + to_team_id + ' ' + to_team_id + '" id="projectmanager_group_chat_message_' + to_team_id +
            '" class="form-control projectmanager_group_chat_message" ></textarea>';
    
        modal_content += '</div><div class="form-group" align="right">';
        modal_content += '<button type="button" name="projectmanager_send_group_chat" id="' + to_team_id +
            '" class="btn btn-round btn-info projectmanager_send_group_chat"><i class="fa fa-paper-plane" aria-hidden="true"></i>  Chat Send</button></div></div>';
        
            // alert(modal_content)
        $('#groupChat_model_details').html(modal_content);
    }


    $(document).on('click', '.start_group_chat', function() {
        // alert(1)
        var team_id = $(this).data('teamid');
        
        var team_name = $(this).data('teamname');

        var id = $("input[name=current_user]").val();

        // alert(team_id)

        update_Read_messages(team_id);

        make_group_chat_dialog_box(team_id, team_name );
        $("#projectmanager_group_chat_dialog_" + team_id).dialog({
            dialogClass: 'custom-ui-widget-header-accessible',
            width: 750,
             minWidth: 700,
             minHeight: 280,
             autoOpen: false,
             position: {
               my: 'center',
               at: 'left+920, top+400', 
             }
           
        });

        if ($('#projectmanager_group_chat_dialog_' + team_id).dialog("isOpen") === true) {
            
               $('#projectmanager_group_chat_dialog_' + team_id).dialog("close");
             } else {
               $('#projectmanager_group_chat_dialog_' + team_id).dialog("open").prev().css('background', '#4B5F71').css('color', '#eee');
               $('#projectmanager_group_chat_message_' + team_id).emojioneArea({
                    pickPosition: "top",
                    toneStyle: "bullet",
                });
             }

    });


$(document).on('click', '.projectmanager_send_group_chat', function() {

  
        var to_team_id = $(this).attr('id');
        var chat_message = $('#projectmanager_group_chat_message_' + to_team_id).val();

        $.ajax({
        url:"{{route('group_chat_store')}}",
        method:"POST",
        data:{chat_message:chat_message, to_team_id:to_team_id,  _token:_token},
        success:function(data){
  
            $('#projectmanager_group_chat_message_').html('');
                var element = $('#projectmanager_group_chat_message_'+ to_team_id).emojioneArea();
                element[0].emojioneArea.setText('');
                $('#projectmanager_group_chat_history_' + to_team_id).html(data);
        }

        })
    });


    function fetch_projectmanager_group_chat_history(to_team_id)
    {
      
        $.ajax({
        url:"{{route('fetch_groupchat_history')}}",
        method:"get",
        data:{to_team_id:to_team_id},
        success:function(data){
            $('#projectmanager_group_chat_history_'+to_team_id).html(data);
            // $('#show-chat-history').html(data);
        }
        })
    }

    function update_projectmanager_group_chat_history_data()
    {
        $('.projectmanager_group_chat_history').each(function(){
        var to_team_id = $(this).data('teamid');
        // alert(to_team_id)
        fetch_projectmanager_group_chat_history(to_team_id);
        update_Read_messages(to_team_id);
        });
    }

    // Image Preview Full Width
var loaderShow = true
var show = '';

$(document).on('click', '.images img', function() {

//   alert(show)
  $("#full-image").attr("src", $(this).attr("src"));
  $('#image-viewer').show();
 
});

    $("#image-viewer .close").click(function(){
  $('#image-viewer').hide();


});

$(document).ready(function() {
    // $('#projectmanager_group_chat_message').focus();

    setTimeout(function() { $('textarea[name="projectmanager_group_chat_message"]').focus() }, 3000);
    
});

$(document).ready(function() {
  var obj = document.createElement("audio");
  obj.src = "{{asset('message/sound/message_sound.mp3')}}";
  obj.volume = 0.1;
  obj.autoPlay = false;
  obj.preLoad = true;
  obj.controls = true;

  $(document).on('click', '.projectmanager_send_group_chat', function() {
    obj.play();
  });
});


var obj = document.createElement("audio");
    obj.src = "{{asset('message/sound/message_sound.mp3')}}";
    obj.volume = 0.1;
    obj.autoPlay = false;
    obj.preLoad = true;
    obj.controls = true;

  $(document).on('click', '#send_group_chat', function() {
    obj.play();

  });

  function sound(){
    var obj = document.createElement("audio");
    obj.src = "{{asset('message/sound/message_sound.mp3')}}";
    obj.volume = 0.1;
    obj.autoPlay = false;
    obj.preLoad = true;
    obj.controls = true;

  $(document).on('click', '.send_chat', function() {
    obj.play();

  });
  }
 


});
</script>