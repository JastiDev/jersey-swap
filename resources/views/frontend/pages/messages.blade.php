@extends ('../../layouts/app')
@section('title')
    Messages - Jersey Swap
@endsection
@section('content')
   <section id="heading" class="mt-5">
     <div class="container">
          <div class="row" style="border: 1px solid gray; border-radius: 8px; height: 600px; margin-bottom: 10px;">
            <div class="col-md-3 user-list" style="height: 100%; overflow-y: scroll; display: flex; flex-direction: column;">
              <input id="search_input" class="form-control" placeholder="Type a username" style="margin-top: 8px;"/>
              <div id="search_result"></div>
              @foreach($user_list as $user)
                <div style="display: flex; flex-flow: row nowrap; margin-top: 4px; cursor: pointer; padding:4px; border-radius: 4px;"
                  onclick="onClickUser('{{$user->username}}', '{{$user->id}}')">
                  <img src="{{ asset($user->profile_picture) }}" style="width:64px; height:64px; border-radius: 32px;" alt="">
                  <div style="display: flex; align-items: center; margin-left: 4px;">{{$user->username}}</div>
                </div>
              @endforeach
            </div>
            <div class="col-md-9 chat-box" style="height: 100%; padding: 4px; display: flex; flex-direction: column;">
              <div class="d-flex align-items-center">
                <i class="fa fa-arrow-left back-icon"></i>
                <span id="chat_with" style="margin: 10px; font-weight: bold;"></span>
              </div>
              <div id="chat_output" style="flex: 1; overflow-y: scroll; padding: 4px; margin: 4px; display: flex; flex-direction:column;">
              </div>
                <div class="mb-3 text-center">
                    <div id="img-gallery" class="row g-3 img-gallery-uploader">
                        
                    </div>
                </div>
                <div style="display: flex; flex-flow: row nowrap;">
                  <input id="chat_input" class="form-control" style="z-index: 1000;" placeholder="Type a message and press Enter"/>
                  
                  <label for="product_photos">
                      <button type="button" id="uitp_gallery" class="btn">
                        <i class="fa fa-paperclip fa-lg" aria-hidden="true"></i>
                      </button>
                  </label>
                  <div style="visibility:hidden; width: 0">
                      <input type="file" id='product_photos' name="file" accept="image/*">
                  </div>
                  <button id="sendBtn" type="submit" class="btn">
                    <i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i>
                  </button>
                </div>
            </div>
          </div>
      </div>
  </section>
@endsection
@section('custom-scripts')
  <script>
    var sendTo = 0;
    var roomNum = 0;
    var userList;
    $(document).ready(function() {

      userList = {!! json_encode($user_list) !!};
      if(userList.length>0){
        sendTo= userList[0].id;
        onClickUser(userList[0].username, userList[0].id);
      } 
    })

    function onClickUser(userName, userId){
      
      $(".chat-box").removeClass("close-list");
      $(".user-list").addClass("close-list");
      $("#chat_with").text("Chat with "+ userName);

      // $(".user-list>div").removeClass("user-selected");
      // $(this).addClass("user-selected");

      // $("#search_result").empty();
      // $("#search_input").empty();

      var chatOutput = "";
      var message_with= parseInt(userId);
      sendTo= message_with;
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: "{{url('/messages/get_by_user')}}",
          method: 'post',
          data : {
              message_with: message_with
          },
          success: function(result){
              console.log("result........", result);
              roomNum = result.room_id;
              if(result.messages.length > 0){
                result.messages.forEach((item)=>{
                    var isImg = item.message_content.slice(0, 6) == "is_img" ? true : false;

                    var img = document.createElement('img');
                    if(isImg) img.setAttribute('src',"{{url('/storage/messages')}}/"+item.message_content);
                    
                    var imgA = document.createElement('a');
                    if(isImg){
                      imgA.setAttribute('href', "{{url('/storage/messages')}}/" + item.message_content);
                      imgA.setAttribute('target', '_blank');
                      imgA.append(img);
                    }

                    var span = document.createElement('span');
                    span.innerHTML = item.message_content;

                    var dateSpan = document.createElement('span');
                    var date = new Date(item.created_at);
                    var options = { year: 'numeric', month: 'short', day: '2-digit' };
                    var month = new Intl.DateTimeFormat('en-US', options).format(date);
                    dateSpan.innerHTML = month + " " + date.getDate() + " " + date.getFullYear() + ", " + ("0" + date.getHours()).slice(-2)  + ":" + ("0" + date.getMinutes()).slice(-2);

                    if(item.sent_from == {{auth()->id()}}){ // if I sent to other.
                      span.style.cssText = 'text-align: right; background: #dbf1ff; border-radius: 4px; padding: 8px;margin-top:2px; width:fit-content; margin-left: auto';
                      dateSpan.style.cssText = 'text-align: right; margin-top:4px; color: grey; font-size: small;';
                      img.style.cssText = 'background: #dbf1ff; border-radius: 4px; padding: 8px;margin-top:2px; width:200px;';
                      imgA.style.cssText = 'margin-left: auto;';
                    }else{
                      span.style.cssText = 'background: #f2f6f9; border-radius: 4px; padding: 8px;margin-top:2px; width:fit-content;';
                      dateSpan.style.cssText = 'margin-top:4px; color: grey; font-size: small;';
                      img.style.cssText = 'background: #f2f6f9; border-radius: 4px; padding: 8px;margin-top:2px; width:200px;';
                      imgA.style.cssText = 'margin-right: auto;';
                    }

                    $("#chat_output").append(dateSpan);
                    if(isImg)$("#chat_output").append(imgA);
                    else $("#chat_output").append(span);
                  });
                  $("#chat_output").animate({scrollTop: $('#chat_output').prop("scrollHeight")}, 500);
                }    
              },
          error: function (request, status, error) {
            console.log(error);
          }
      });

      $("#chat_output").html(chatOutput);
      
    }

    $("#search_input").bind('input', function() { 
        keyword = $(this).val();
        $("#search_result").empty();
        if(keyword.length>3){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url: "{{url('/messages/get_users')}}",
              method: 'post',
              data : {
                  keyword: keyword
              },
              success: function(result){
                result.users.forEach((item)=>{

                    var userDiv = $("<div style='display: flex; flex-flow: row nowrap; margin-top: 8px; cursor: pointer;'></div>");
                    
                    userDiv.click(function() {
                      onClickUser(item.username, item.id);
                    });

                    var img = document.createElement('img');
                    img.setAttribute('src',base_url+'/'+item.profile_picture);
                    img.style.cssText = "width:64px; height: 64px; border-radius: 32px;";
                    userDiv.append(img);

                    var usernameDiv = $("<div style='display: flex; align-items: center; margin-left: 4px;'>"+item.username+"</div>");
                    userDiv.append(usernameDiv);

                    $("#search_result").append(userDiv);
                });
              },
              error: function (request, status, error) {
                console.error(error);
              }
          });
        }
      });

    $(".back-icon").click(function() {
      $(".chat-box").addClass("close-list");
      $(".user-list").removeClass("close-list");
    })


    let ws = new WebSocket('{{getenv('CHAT_WSS_URL')}}');
  
    console.log({{auth()->id()}});
    
    ws.onopen = function (e) {
        // Connect to websocket
        console.log('Connected to websocket');
        var me = {{auth()->id()}};
        // ws.send(JSON.stringify({command: "register", userId: me}));
        // if(sendTo != 0) ws.send(JSON.stringify({command: "register", userId: {{auth()->id()}}}));
        ws.send(
            JSON.stringify({
                'type': 'socket',
                'user_id': '{{auth()->id()}}'
            })
        );

        // Bind onkeyup event after connection
        $('#chat_input').on('keyup', function (e) {
            let img_str = '';
            let message_content = $(this).val();
            $('#img-gallery').children().each(function () {
              img_str += $(this).children().children("input").val() + ":::";
            });
            if((img_str.length > 0 || message_content != '') && sendTo != 0){
              if (e.keyCode === 13 && !e.shiftKey) {
                  console.log("roomNum__  ", roomNum);
                  ws.send(
                      JSON.stringify({
                          'type': 'chat',
                          'from': '{{auth()->id()}}',
                          'to': sendTo,
                          'room_id': roomNum,
                          'message_content': message_content,
                          'images_str':img_str
                      })
                  );
                  $(this).val('');
                  $('#img-gallery').empty();
                  console.log('{{auth()->id()}} sent ' + message_content);
              }
            }
        });
        $('#sendBtn').click(function (e) {
            let message_content = $('#chat_input').val();
            let img_str = '';
            $('#img-gallery').children().each(function () {
              img_str += $(this).children().children("input").val() + ":::";
            });
            if((img_str.length > 0 || message_content != '') && sendTo != 0){
              ws.send(
                  JSON.stringify({
                      'type': 'chat',
                      'from': '{{auth()->id()}}',
                      'to': sendTo,
                      'room_id': roomNum,
                      'message_content': message_content,
                      'images_str':img_str
                  })
              );
              $('#chat_input').val('');
              $('#img-gallery').empty();
              
              console.log('{{auth()->id()}} sent ' + message_content);
            }
        });
    };
    ws.onerror = function (e) {
        // Error handling
        console.log(e);
       // alert('Check if WebSocket server is running!');
    };
    ws.onclose = function(e) {
        console.log(e);
        //alert('Check if WebSocket server is running!');
    };
    ws.onmessage = function (e) {
        // console.trace(e);
        console.log('onmessage.......');
        let json = JSON.parse(e.data);
        console.log(json)
        switch (json.type) {
            case 'chat':
                var hasHistory = false;
                var sentUser;
                userList.forEach((item)=>{
                  if(item.id == json.from){
                    hasHistory = true;
                    sentUser = item;
                  }
                })
                if(json.from != 'me' && hasHistory){
                  onClickUser(sentUser.username, json.from);
                }else if(json.from != 'me' && !hasHistory){
                  location.reload();
                }
                var span = document.createElement('span');
                span.innerHTML = json.msg;

                var dateSpan = document.createElement('span');
                var dateNow = Date.now();
                var date = new Date(dateNow);

                var options = { year: 'numeric', month: 'short', day: '2-digit' };
                var month = new Intl.DateTimeFormat('en-US', options).format(date);
                dateSpan.innerHTML = month + " " + date.getDate() + " " + date.getFullYear() + ", " + ("0" + date.getHours()).slice(-2)  + ":" + ("0" + date.getMinutes()).slice(-2);

                if(json.from == 'me'){
                  span.style.cssText = 'text-align: right; background: #dbf1ff; border-radius: 4px; padding: 8px;margin-top:2px; width:fit-content; margin-left: auto';
                  dateSpan.style.cssText = 'text-align: right; margin-top:4px; color: grey; font-size: small;';
                }else{
                  span.style.cssText = 'background: #f2f6f9; border-radius: 4px; padding: 8px;margin-top:2px; width:fit-content;';
                  dateSpan.style.cssText = 'margin-top:4px; color: grey; font-size: small;';
                }

                $('#chat_output').append(dateSpan); // Append the new message received
                $('#chat_output').append(span); // Append the new message received
                $("#chat_output").animate({scrollTop: $('#chat_output').prop("scrollHeight")}, 1000); // Scroll the chat output div
                console.log("Received " + json.msg);
                break;

            case 'img':
                var img = document.createElement('img');
                img.setAttribute('src',"{{url('/storage/messages')}}/"+json.msg);
                
                var imgA = document.createElement('a');
                imgA.setAttribute('href', "{{url('/storage/messages')}}/" + json.msg);
                imgA.setAttribute('target', '_blank');
                imgA.append(img);

                var dateSpan = document.createElement('span');
                var dateNow = Date.now();
                var date = new Date(dateNow);

                var options = { year: 'numeric', month: 'short', day: '2-digit' };
                var month = new Intl.DateTimeFormat('en-US', options).format(date);
                dateSpan.innerHTML = month + " " + date.getDate() + " " + date.getFullYear() + ", " + ("0" + date.getHours()).slice(-2)  + ":" + ("0" + date.getMinutes()).slice(-2);

                if(json.from == 'me'){
                  img.style.cssText = 'background: #dbf1ff; border-radius: 4px; padding: 8px;margin-top:2px; width:200px; margin-left: auto';
                  imgA.style.cssText = 'margin-left: auto;';
                  dateSpan.style.cssText = 'text-align: right; margin-top:4px; color: grey; font-size: small;';
                }else{
                  imgA.style.cssText = 'margin-right: auto;';
                  img.style.cssText = 'background: #f2f6f9; border-radius: 4px; padding: 8px;margin-top:2px; width:200px;';
                  dateSpan.style.cssText = 'margin-top:4px; color: grey; font-size: small;';
                }

                $('#chat_output').append(dateSpan); // Append the new message received
                $('#chat_output').append(imgA); // Append the new message received
                $("#chat_output").animate({scrollTop: $('#chat_output').prop("scrollHeight")}, 1000); // Scroll the chat output div
                console.log("Received " + json.msg);
                break;

            case 'socket':
                $('#total_client').html(json.msg);
                console.log("Received: " + json.msg);
                break;
        }
    };
  </script>
@endsection
