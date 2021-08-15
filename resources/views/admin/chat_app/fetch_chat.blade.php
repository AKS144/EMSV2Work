
  <div  id="show-chat-history">

          @foreach($employees_chats as $row)

           @if($row->from_employee_id == auth()->user()->id)
            
                @if($row->status == '2')

                    <div class="msg">
                        <div class="bubble alt">
                        <div class="txt">
                            <span class="name alt">My Name</span>
                            <span class="timestamp">{{date('H:i A' ,strtotime($row->created_at))}}</span>
                            @else
                            <div class="msg">
                        <div class="bubble alt">
                        <div class="txt">
                            <span class="name alt">My Name</span>
                            <p class="message">{{$row->message}}</p>
                            <span class="timestamp">{{date('H:i A' ,strtotime($row->created_at))}}</span>
                            
                        </div>
                        <div class="bubble-arrow alt"></div>
                        </div>
                    </div>
                @endif
          @else

          @if($row->status == '2')
           <em>This message has been removed</em>
           @else
          <div class="msg">
            <div class="bubble">
              <div class="txt">
                <span class="name">{{$username}}</span></span>
                <span class="timestamp">{{date('H:i A' ,strtotime($row->created_at))}}</span>
                <p class="message">{{$row->message}}</p>
              </div>
              <div class="bubble-arrow"></div>
            </div>
          </div>  
          </div>
        @endif
        @endif

          @endforeach
          </div>



          <div class="msg " style="'.$dynamic_background.'" >
                <div class="bubble alt" style="'.$dynamic_background.'" >
                    <div class="txt" style="'.$dynamic_background.'" >
                    <span class="name" style="'.$dynamic_background.'" >'.$user_name.'</span>
                    <span class="timestamp" style="'.$dynamic_background.'" >'.$row->created_at.'</span>      
                    <span class="message" style="'.$dynamic_background.'" >
                    '.$chat_message.'
                    </span> 
                    
                    </div>
                    <div class="bubble-arrow"></div>
                </div>
                </div> 