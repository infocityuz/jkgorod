@section('title') {{__('locale.apartment_sale')}}  @endsection
@extends('forthebuilder::layouts.forthebuilder')



@section('title')  {{translate('User show')}} @endsection
<style>
#chat_area
{
	min-height: 500px;
	max-height: 70vh;
	/*overflow-y: scroll*/;
}

#chat_history
{
    width: 100%;
	height: 79%; 
	overflow-y: scroll; 
	margin-bottom:16px; 
	background-color: #ffffff;
	padding: 16px;
}

#user_list
{
	min-height: 500px; 
	max-height: 750px; 
	overflow-y: auto;
	padding: 0 5px;
}
.sender_chat
{
    background-color: #94B2EB !important;
    border-radius: 20px !important;
}
.recever_chat
{
    background-color: #E8F0FF !important;
    border-radius: 20px !important;
}
.content_center {
  display: flex;
  justify-content: center !important;
  align-items: center !important; 

}

.chatIsThreeInput {
	border-radius: 3px !important;
}



</style>
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')
            <div class="d-flex justify-content-between" style="width: 992px;">
                <div class="d-flex">
                    <h2 class="panelUprText profileTextProfile">{{translate('Chat')}}</h2>
                </div>
            </div>

            <div class="d-flex align-items-start px-4">
                <div class="bg-white rounded">
                    <div class="row mt-3">
                        <div class="col-md-1">
                        </div>
                        <div class="col col-md-2 pr-0" id="group">
                        </div>
                        <div class="col col-md-3" id="chat_header">
                            {{-- <b>Private chat</b> --}}
                        </div>
                    </div>
                    <div class="profileChartChat pt-0 mt-0" id="chat_area">
                        {{-- <h5 class="MoyiZadachiTextCartGreenH5">{{translate('Chat')}}</h5> --}}

                        {{-- <div class="card-body pt-0" id="chat_area">
				
                        </div> --}}
                    </div>

                </div>

                <div class="allUsersProfile rounded">
                    <h5 class="text-center mt-2 MoyiZadachiTextCartGreenH5">{{translate('My team')}}</h5>
                    <div  id="user_list">
                         {{-- <button onclick="load_connected_chat_user()">send</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script>
        let page_name = 'chats';

        $(document).on('keyup', '#message_area', function(e) {
                    e.preventDefault()
                    if(e.which == 13) {
                        $('#send_button').trigger('click')
                    }
        });


        // var conn = new WebSocket('http://businesshouse-kg.icstroy.com:30000/?token={{ auth()->user()->token }}');

        var conn = new WebSocket('ws://127.0.0.1:1235/?token={{ auth()->user()->token }}');
        // http://127.0.0.1/

        var from_user_id = "{{ Auth::user()->id }}";

        var to_user_id = "";

        conn.onopen = function(e) {
            console.log("new connection ");

            load_connected_chat_user(from_user_id);
        };
        
        conn.onmessage = function(e) {

            console.log(e.data);

            var data = JSON.parse(e.data); 

            if(data.response_connected_chat_user)
            {
                var html = '<div class="list-group">';

                if(data.data.length > 0)
                {
                    for(var count = 0; count < data.data.length; count++)
                    {
                        html += `
                        <a href="#" class="list-group-item d-flex justify-content-between align-items-start" onclick="make_chat_area(`+data.data[count].id+`, '`+data.data[count].first_name+`'); load_chat_data(`+from_user_id+`, `+data.data[count].id+`); ">
                            <div class="ms-2 me-auto">
                        `;

                        var last_seen = '';

                        // html += '<span class="online_status_icon" id="status_'+data.data[count].id+'"><i class="fas fa-circle"></i></span>';

                        last_seen = data.data[count].last_seen;

                        // var user_image = '';
                        console.log(data.data[count].user_image);
                        if(data.data[count].user_image == null)
                        {
                            user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`;
                            // {{asset('uploads/user/'.$model->id.'/s_'.$model->avatar)}}
                           
                        }
                        else
                        {
                            user_image = `<img src="{{ asset('uploads/user/') }}/`+data.data[count].id+`/s_`+data.data[count].user_image+`" width="35" class="rounded-circle" />`;
                            // user_image = `<img src="{{ asset('images/no-image.jpg') }}" width="35" class="rounded-circle" />`;
                        }



                        html += `
                                &nbsp; `+user_image+`&nbsp;<b>`+data.data[count].name+`</b>
                                <div class="ml-5"><small class="text-muted last_seen" id="last_seen_`+data.data[count].id+`">`+data.data[count].user_role_name+`</small></div>
                            </div>
                        </a>
                        `;
                    }
                }
                else
                {
                    html += 'No User Found';
                }

                

                html += '</div>';
                document.getElementById('user_list').innerHTML = html;
                document.getElementById('group').innerHTML = `<button type="button" id="close_chat_group" class="btn  float-end one_chat" onclick="make_group_chat_area(); load_group_chat_data(`+from_user_id+`);">{{ translate("General chat")}}</button>`;
                document.getElementById('chat_header').innerHTML = `<button type="button" id="close_chat" class="btn  float-end  group_chat" onclick="close_chat();">{{ translate("Private chat")}}</button>`;


                var html = `
                <div id="chat_history"></div>
                <div class="input-group">
                    <input type="text" class="chatIsThreeInput mt-0 form-control" id="message_area" placeholder="{{ translate("quick response")}}">
                    <button type="button" class="btn btn-success d-none" id="send_button" onclick="send_group_chat_message()"><i class="fas fa-paper-plane"></i></button>
                </div>
                `;

                document.getElementById('chat_area').innerHTML = html;

                var data = {
                from_user_id : from_user_id,
                type : 'request_connected_group_chat_user_history'
                };
                console.log(data);
                conn.send(JSON.stringify(data));



                // load_chat_data();
                // load_chat_data(`+from_user_id+`);
                // check_unread_message();
            }
            if(data.message)
            {
                console.log('camne');
                console.log(data);
                var html = '';

                if(data.from_user_id == from_user_id)
                {
                    html += `
                    <div class="row">
                        <div class="col col-2">&nbsp;</div>
                        <div class="col col-10 alert  text-dark sender_chat">
                            <div class="row">
                                <div class="col-md-10">
                                    <b>
                                        `+data.sender_connection[0].first_name+` `+data.sender_connection[0].last_name+`
                                    </b> <br>
                                   `+data.message+`
                                </div>
                                <div class="col-md-2">
                                `

                                
                    if(data.sender_connection[0].avatar== null)
                    {
                        user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                    }
                    else{
                        user_image = `<img src="{{ asset('uploads/user/') }}/`+data.from_user_id+`/s_`+data.sender_connection[0].avatar+`" width="35" class="rounded-circle" />`
                    }

                    html += `
                     `+user_image+` <br> 
                        <b>
                          `+data.time+`
                        </b>
                               </div>
                            </div>
                        </div>
                    </div>
                        `;
                                  
                                
                }
                else
                {
                    // console.log(to_user_id);
                    if(to_user_id != '')
                    {

                        html += `
                        <div class="row">
                            <div class="col col-9 alert  text-dark recever_chat">
                                <div class="row">
                                    <div class="col-md-2">
                                    `
                    if(data.sender_connection[0].avatar== null)
                    {
                        user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                    }
                    else{
                        user_image = `<img src="{{ asset('uploads/user/') }}/`+data.from_user_id+`/s_`+data.sender_connection[0].avatar+`" width="35" class="rounded-circle" />`
                    }
                        html += `
                        &nbsp; `+user_image+`
                                    </div>
                                    <div class="col-md-10">
                                        <b>
                                           `+data.sender_connection[0].first_name+`,`+data.sender_connection[0].last_name+`
                                        </b> <br>
                                        `+data.message+`
                                        <b style="float:right">`+data.time+`</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                                    
                                


                        // update_message_status(data.chat_message_id, from_user_id, to_user_id, 'Read');
                    }
                    else
                    {
                        var count_unread_message_element = document.getElementById('user_unread_message_'+data.from_user_id+'');
                        if(count_unread_message_element)
                        {
                            var count_unread_message = count_unread_message_element.textContent;
                            if(count_unread_message == '')
                            {
                                count_unread_message = parseInt(0) + 1;
                            }
                            else
                            {
                                count_unread_message = parseInt(count_unread_message) + 1;
                            }
                            count_unread_message_element.innerHTML = '<span class="badge bg-primary rounded-pill">'+count_unread_message+'</span>';

                            // update_message_status(data.chat_message_id, data.from_user_id, data.to_user_id, 'Send');
                        }
                    }
                    
                }

                if(html != '')
                {
                    var previous_chat_element = document.querySelector('#chat_history');

                    var chat_history_element = document.querySelector('#chat_history');

                    chat_history_element.innerHTML = previous_chat_element.innerHTML + html;
                    // scroll_top();
                }
                
            }
            if(data.chat_history)
            {
                var html = '';

                for(var count = 0; count < data.chat_history.length; count++)
                {
                    if(data.chat_history[count].user_from_id == from_user_id)
                    {
                        html += `
                        <div class="row">
                            <div class="col col-2">&nbsp;</div>
                            <div class="col col-10 alert  text-dark sender_chat">
                                <div class="row">
                                    <div class="col-md-10">
                                        <b>
                                            `+data.sender_connection.first_name+` `+data.sender_connection.last_name+`
                                        </b> <br>
                                        `+data.chat_history[count].text+`
                                    </div>
                                    <div class="col-md-2">
                                    `

                                    
                        if(data.sender_connection.avatar== null)
                        {
                            user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                        }
                        else{
                            user_image = `<img src="{{ asset('uploads/user/') }}/`+data.chat_history[count].user_from_id+`/s_`+data.sender_connection.avatar+`" width="35" class="rounded-circle" />`
                        }

                        html += `
                          `+user_image+`
                            <b>
                            `+data.chat_history[count].time+`
                            </b>                        
                                </div>
                                </div>
                            </div>
                        </div>
                            `;   
                    }
                    else
                    {

                        html += `
                        <div class="row">
                            <div class="col col-9 alert  text-dark recever_chat">
                                <div class="row">
                                    <div class="col-md-2">
                                    `
                        if(data.receiver_connection.avatar== null)
                        {
                            user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                        }
                        else{
                            user_image = `<img src="{{ asset('uploads/user/') }}/`+data.chat_history[count].user_from_id+`/s_`+data.receiver_connection.avatar+`" width="35" class="rounded-circle" />`
                        }
                        html += `
                        &nbsp; `+user_image+`
                                    </div>
                                    <div class="col-md-10">
                                        <b>
                                           `+data.receiver_connection.first_name+``+data.receiver_connection.last_name+`
                                        </b> <br>
                                        `+data.chat_history[count].text+`
                                        <b style="float:right" class"time">`+data.chat_history[count].time+`</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                                    
                                


                        // // update_message_status(data.chat_message_id, from_user_id, to_user_id, 'Read');
                        // html += `
                        // <div class="row">
                        //     <div class="col col-9 alert alert-light text-dark shadow-sm">
                        //     `+data.chat_history[count].text+`
                        //     </div>
                        // </div>
                        // `;

                        var count_unread_message_element = document.getElementById('user_unread_message_'+data.chat_history[count].from_user_id+'');

                        if(count_unread_message_element)
                        {
                            count_unread_message_element.innerHTML = '';
                        }
                    }
                }

                document.querySelector('#chat_history').innerHTML = html;

                // scroll_top();
            }
            if(data.group_message)
            {
                console.log('camne');
                console.log(data);
                var html = '';

                if(data.from_user_id == from_user_id)
                {
                    html += `
                    <div class="row">
                        <div class="col col-2">&nbsp;</div>
                        <div class="col col-10 alert  text-dark sender_chat">
                            <div class="row">
                                <div class="col-md-10">
                                    <b>
                                        `+data.sender_connection.first_name+`,`+data.sender_connection.last_name+`
                                    </b> <br>
                                   `+data.group_message+`
                                   
                                </div>
                                <div class="col-md-2">
                                `

                                
                    if(data.sender_connection.avatar== null)
                    {
                        user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                    }
                    else{
                        user_image = `<img src="{{ asset('uploads/user/') }}/`+data.from_user_id+`/s_`+data.sender_connection.avatar+`" width="35" class="rounded-circle" />`
                    }

                    html += `
                     `+user_image+`
                     <b>
                        `+data.time+`
                     </b>
                               </div>
                            </div>
                        </div>
                    </div>
                        `;
                                  
                                
                }
                else
                {
                    // console.log(to_user_id);
                    // if(to_user_id != '')
                    // {

                        html += `
                        <div class="row">
                            <div class="col col-9 alert recever_chat text-dark ">
                                <div class="row">
                                    <div class="col-md-2">
                                    `
                        if(data.sender_connection.avatar== null)
                        {
                            user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                        }
                        else{
                            user_image = `<img src="{{ asset('uploads/user/') }}/`+data.from_user_id+`/s_`+data.sender_connection.avatar+`" width="35" class="rounded-circle" />`
                        }



                        html += `
                        &nbsp; `+user_image+`
                                    </div>
                                    <div class="col-md-10">
                                        <b>
                                           `+data.sender_connection.first_name+`,`+data.sender_connection.last_name+`
                                        </b> <br>
                                        `+data.group_message+`
                                        <span style="float:right">`+data.time+`</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                                    
                                


                        // update_message_status(data.chat_message_id, from_user_id, to_user_id, 'Read');
                    // }
                    // else
                    // {
                    //     var count_unread_message_element = document.getElementById('user_unread_message_'+data.from_user_id+'');
                    //     if(count_unread_message_element)
                    //     {
                    //         var count_unread_message = count_unread_message_element.textContent;
                    //         if(count_unread_message == '')
                    //         {
                    //             count_unread_message = parseInt(0) + 1;
                    //         }
                    //         else
                    //         {
                    //             count_unread_message = parseInt(count_unread_message) + 1;
                    //         }
                    //         count_unread_message_element.innerHTML = '<span class="badge bg-primary rounded-pill">'+count_unread_message+'</span>';

                    //         // update_message_status(data.chat_message_id, data.from_user_id, data.to_user_id, 'Send');
                    //     }
                    // }
                    
                }

                if(html != '')
                {
                    var previous_chat_element = document.querySelector('#chat_history');

                    var chat_history_element = document.querySelector('#chat_history');

                    chat_history_element.innerHTML = previous_chat_element.innerHTML + html;
                    // scroll_top();
                }
                
            }
            if (data.group_chat_history) {
                console.log(data);
                var html = '';

                for(var count = 0; count < data.group_chat_history.length; count++)
                {
                    // console.log(data.group_chat_history[count].user_from_id);
                    if(data.group_chat_history[count].user_from_id == from_user_id)
                    {


                        html += `
                        <div class="row">
                            <div class="col col-2">&nbsp;</div>
                            <div class="col col-10 alert  text-dark sender_chat">
                                <div class="row">
                                    <div class="col-md-10">
                                        <b>
                                            `+data.group_chat_history[count].first_name+` `+data.group_chat_history[count].last_name+`
                                        </b> <br>
                                        `+data.group_chat_history[count].text+`
                                    </div>
                                    <div class="col-md-2">
                                    `

                                    
                        if(data.group_chat_history[count].avatar== null)
                        {
                            user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                        }
                        else{
                            user_image = `<img src="{{ asset('uploads/user/') }}/`+data.group_chat_history[count].user_from_id+`/s_`+data.group_chat_history[count].avatar+`" width="35" class="rounded-circle" />`
                        }

                        html += `
                            `+user_image+`<br>
                            <b>
                            `+data.group_chat_history[count].time+`
                            </b>
                                </div>
                                </div>
                            </div>
                        </div>
                            `;   


                        
                    }
                    else
                    {
                        html += `
                        <div class="row">
                            <div class="col col-9 alert recever_chat text-dark ">
                                <div class="row">
                                    <div class="col-md-2">
                                    `
                        if(data.group_chat_history[count].avatar== null)
                        {
                            user_image = `<img src="{{ asset('/backend-assets/forthebuilders/images/X.png') }}" width="35" class="rounded-circle" />`
                        }
                        else{
                            user_image = `<img src="{{ asset('uploads/user/') }}/`+data.group_chat_history[count].user_from_id+`/s_`+data.group_chat_history[count].avatar+`" width="35" class="rounded-circle" />`
                        }
                        html += `
                        &nbsp; `+user_image+`
                                    </div>
                                    <div class="col-md-10">
                                        <b>
                                           `+data.group_chat_history[count].first_name+` `+data.group_chat_history[count].last_name+`
                                        </b> <br>
                                        `+data.group_chat_history[count].text+`
                                        <b style="float:right">`+data.group_chat_history[count].time+`</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                    }
                }

                document.querySelector('#chat_history').innerHTML = html;
            }


        };

        function load_connected_chat_user(from_user_id)
        {
            var data = {
                from_user_id : from_user_id,
                type : 'request_connected_chat_user'
            };

            conn.send(JSON.stringify(data));
        }


        function make_chat_area(user_id, to_user_name)
        {
            var html = `
            <div id="chat_history"></div>
            <div class="input-group">
                <input type="text" class="chatIsThreeInput mt-0 form-control" id="message_area" placeholder="{{ translate("quick response")}}"> 
                <button type="button" class="btn btn-success d-none" id="send_button" onclick="send_chat_message()"><i class="fas fa-paper-plane"></i></button>
            </div>
            `;



            document.getElementById('chat_header').innerHTML = `<button type="button" id="close_chat" class="btn  float-end group_chat" onclick="make_chat_area(`+user_id+`, '`+to_user_name+`'); load_chat_data(`+from_user_id+`, `+user_id+`);">`+to_user_name+`</button>`;

            document.getElementById('chat_area').innerHTML = html;
            // document.getElementById('close_chat_group').style.backgroundColor="#17a2b8";
            // document.getElementById('close_chat').style.backgroundColor="#92b0e8";

            document.getElementById('close_chat_group').style.backgroundColor="#94B2EB";
            document.getElementById('close_chat_group').style.color="#ffffff";
            document.getElementById('close_chat').style.backgroundColor="#ffffff";
            document.getElementById('close_chat').style.color="#000000";


            // document.getElementById('chat_header').innerHTML = '<b>'+to_user_name+'</b>';

            // document.getElementById('close_chat_area').innerHTML = '<button type="button" id="close_chat" class="btn btn-danger btn-sm float-end" onclick="close_chat();"><i class="fas fa-times"></i></button>';

            to_user_id = user_id;
        }


        function make_group_chat_area()
        {
            var html = `
            <div id="chat_history"></div>
            <div class="input-group">
                <input type="text" class="chatIsThreeInput mt-0 form-control" id="message_area" placeholder="{{ translate("quick response")}}">
                <button type="button" class="btn btn-success d-none" id="send_button" onclick="send_group_chat_message()"><i class="fas fa-paper-plane"></i></button>
            </div>
            `;

            document.getElementById('chat_area').innerHTML = html;
            // document.getElementById('close_chat_group').style.backgroundColor="#94B2EB";
            // document.getElementById('close_chat_group').style.color="#ffffff";
            // document.getElementById('close_chat').style.backgroundColor="#ffffff";
            // document.getElementById('close_chat').style.color="#000000";

            document.getElementById('close_chat_group').style.backgroundColor="#ffffff";
            document.getElementById('close_chat_group').style.color="#000000";
            document.getElementById('close_chat').style.backgroundColor="#94B2EB";
            document.getElementById('close_chat').style.color="#ffffff";

        }
        function send_group_chat_message()
        {
            
            document.querySelector('#send_button').disabled = true;

            var message = document.getElementById('message_area').value.trim();

            var data = {
                message : message,
                from_user_id : from_user_id,
                type : 'request_send_group_chat_message'
            };
            console.log(data);
            conn.send(JSON.stringify(data));

            document.querySelector('#message_area').value = '';

            document.querySelector('#send_button').disabled = false;
        }

        function load_group_chat_data()
        {
            var data = {
                from_user_id : from_user_id,
                type : 'request_connected_group_chat_user_history'
            };
            console.log(data);
            conn.send(JSON.stringify(data));
        }
        function send_chat_message()
        {
            console.log();
            document.querySelector('#send_button').disabled = true;

            var message = document.getElementById('message_area').value.trim();

            var data = {
                message : message,
                from_user_id : from_user_id,
                to_user_id : to_user_id,
                type : 'request_send_message'
            };

            conn.send(JSON.stringify(data));

            document.querySelector('#message_area').value = '';

            document.querySelector('#send_button').disabled = false;
        }
        function load_chat_data(from_user_id, to_user_id)
        {
            var data = {
                from_user_id : from_user_id,
                to_user_id : to_user_id,
                type : 'request_chat_history'
            };

            conn.send(JSON.stringify(data));
        }
        function close_chat()
        {



            html= `
                   <div class="row">
                        <div class=" col-md-12 text-dark text-center" style="margin-top: 100px;" >
                        <b>
                            {{ translate("There is nothing here yet")}}
                            </b>  <br> 
                            <b class="">
                            {{translate('Select a user to write to him')}} 
                        </b>
                             
                        </div>
                    </div>
                        `;

            document.getElementById('chat_area').innerHTML = html;
            // document.getElementById('close_chat_group').style.backgroundColor="#17a2b8";
            // document.getElementById('close_chat').style.backgroundColor="#92b0e8";


            document.getElementById('close_chat_group').style.backgroundColor="#94B2EB";
            document.getElementById('close_chat_group').style.color="#ffffff";
            document.getElementById('close_chat').style.backgroundColor="#ffffff";
            document.getElementById('close_chat').style.color="#000000";


        }
        



    </script>
    <script>
        let page_name = 'user';
        const ctx = document.getElementById('circleCharts');
            let circleCharts = document.getElementById("circleCharts").getContext('2d');
            let graphicCharts = document.getElementById("graphicCharts").getContext('2d');
            let tasks = '{{$tasks}}';
            let taskdate = [];
            let taskcount = [];
            let m = [];
            @if(!empty($task_count))
                @foreach($task_count['task_date'] as $task_date_)
                    taskdate.push('{{$task_date_}}')
                @endforeach
                @foreach($task_count['count'] as $task_count_)
                    taskcount.push('{{$task_count_}}')
                @endforeach
            @endif
            @if(!empty($monthly_count))
                @foreach($monthly_count as $key => $monthly_count_)
                    m['{{$key}}'] = '{{(int)$monthly_count_-1}}'
                @endforeach
            @endif
            let tasks_not_ended = '{{$tasks_not_ended}}';
            let tasks_ended = '{{$tasks_ended}}';
            @if($tasks_ended == 0 && $tasks_not_ended == 0)
                tasks_ended = 1;
            @endif
            circleCharts.canvas.parentNode.style.height = '144px';
            circleCharts.canvas.parentNode.style.width = '244px';
            let one = new Chart(graphicCharts, {
                type: 'line',
                data: {
                    labels: [1,2,3,4,5,6,7,8,9,10,11,12],
                    datasets:[{
                        label: 'Tasks',
                        data: [m['01'], m['02'], m['03'], m['04'], m['05'], m['06'], m['07'], m['08'], m['09'], m['10'],  m['11'],  m['12']],
                        backgroundColor: [
                            'green'
                        ],
                        borderColor: [
                            'green',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true,
                }
            })
            let two = new Chart(circleCharts, {
                type: 'doughnut',
                data: {
                    // labels: ['Completed tasks','In work', 'Tasks not completed'],
                    datasets:[{
                        label: ['Tasks'],
                        data: [parseInt(tasks_not_ended), parseInt(tasks_ended)],
                        backgroundColor: [
                            '#E44848',
                            '#65AF37',
                        ],
                        borderColor: [
                            '#E44848',
                            '#65AF37',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true,
                }
            })

    </script>
   
@endsection







