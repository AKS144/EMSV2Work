<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400,700);
 *, *:before, *:after {
	 box-sizing: border-box;
}
 /* body {
	 background: #c5ddeb;
	 font: 14px/20px "Lato", Arial, sans-serif;
	 padding: 40px 0;
	 color: white;
} */
 /* .container {
	 margin: 0 auto;
	 background: #444753;
	 border-radius: 5px;
} */
 .people-list {
	 width: 260px;
	 float: left;
	 background: #4B5F71;
	 border-radius: 5px;
	 color:#ffffff;
}
 .people-list .search {
	 padding: 20px;
}
 .people-list input {
	 border-radius: 3px;
	 border: none;
	 padding: 14px;
	 color: white;
	 background: #4B5F71;
	 width: 90%;
	 font-size: 14px;
	 list-style:none;
	 text-decoration:none;
}
 .people-list .fa-search {
	 position: relative;
	 left: -25px;
	 list-style:none;
	 text-decoration:none;
}
 .people-list ul {
	 padding: 20px;
	 height: 770px;
	 list-style:none;
	 text-decoration:none;
}
 .people-list ul li {
	 padding-bottom: 20px;
	 list-style:none;
	 text-decoration:none;
}
 .people-list img {
	 float: left;
}
 .people-list .about {
	 float: left;
	 margin-top: 8px;
}
 .people-list .about {
	 padding-left: 8px;
}
 .people-list .status {
	 color: #92959e;
}
 .chat {
	 width: 550px;
	 float: left;
	 /* background: #4B5F71; */
	 border-top-right-radius: 5px;
	 border-bottom-right-radius: 5px;
	 color: #434651;
}

.Offline{
background:#F5736F;
color:#ffffff;
}

.Offline:hover{
background:#F5736F;
color:#ffffff;
}


.Online{
background:#1ABB9C;
color:#ffffff;
}

.Online:hover{
background:#1ABB9C;
color:#ffffff;
}


.chat_history{
	/* background: #4B5F71; */
}

.custom-ui-widget-header-accessible {
  background: #C2D7E9;
  font-size: 1em;
}

.ui-dialog-titlebar {
  background: #337AB7;
}


/* .chat_message {
  width: 100%;
  min-height: 100px;
  resize: none;
  border-radius: 8px;
  border: 1px solid #ddd;
  padding: 0.5rem;
  color: #666;
  box-shadow: inset 0 0 0.25rem #ddd;
} */

/* .chat_message:focus {
  outline: none;
  background-color: #FFFFD1;
  border: 1px solid #B2B2B2;
  box-shadow: inset 0 0 1rem #EEEEEE
} */

.user_dialog{
	background: #4B5F71;
}
 .chat .chat-header {
	 padding: 20px;
	 border-bottom: 2px solid white;
}
 .chat .chat-header img {
	 float: left;
}
 .chat .chat-header .chat-about {
	 float: left;
	 padding-left: 10px;
	 margin-top: 6px;
}
 .chat .chat-header .chat-with {
	 font-weight: bold;
	 font-size: 16px;
}
 .chat .chat-header .chat-num-messages {
	 color: #92959e;
}
 .chat .chat-header .fa-star {
	 float: right;
	 color: #d8dadf;
	 font-size: 20px;
	 margin-top: 12px;
}
 .chat .chat-history {
	 padding: 30px 30px 20px;
	 border-bottom: 2px solid white;
	 overflow-y: scroll;
	 height: 575px;
}
 .chat .chat-history .message-data {
	 margin-bottom: 15px;
}
 .chat .chat-history .message-data-time {
	 color: #a8aab1;
	 padding-left: 6px;
}
 .chat .chat-history .message {
	 color: white;
	 padding: 18px 20px;
	 line-height: 26px;
	 font-size: 16px;
	 border-radius: 7px;
	 margin-bottom: 30px;
	 width: 90%;
	 position: relative;
}
 .chat .chat-history .message:after {
	 bottom: 100%;
	 left: 7%;
	 border: solid transparent;
	 content: " ";
	 height: 0;
	 width: 0;
	 position: absolute;
	 pointer-events: none;
	 border-bottom-color: #86bb71;
	 border-width: 10px;
	 margin-left: -10px;
}
 .chat .chat-history .my-message {
	 background: #86bb71;
}
 .chat .chat-history .other-message {
	 background: #94c2ed;
}
 .chat .chat-history .other-message:after {
	 border-bottom-color: #94c2ed;
	 left: 93%;
}
 .chat .chat-message {
	 padding: 30px;
}
 .chat .chat-message textarea {
	 width: 100%;
	 border: none;
	 padding: 10px 20px;
	 font: 14px/22px "Lato", Arial, sans-serif;
	 margin-bottom: 10px;
	 border-radius: 5px;
	 resize: none;
}
 .chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
	 font-size: 16px;
	 color: gray;
	 cursor: pointer;
}
 .chat .chat-message button {
	 float: right;
	 color: #94c2ed;
	 font-size: 16px;
	 text-transform: uppercase;
	 border: none;
	 cursor: pointer;
	 font-weight: bold;
	 background: #f2f5f8;
}
 .chat .chat-message button:hover {
	 color: #75b1e8;
}
 .online, .offline, .me {
	 margin-right: 3px;
	 font-size: 10px;
}
 .online {
	 color: #86bb71;
}
 .offline {
	 color: #e38968;
}
 .me {
	 color: #94c2ed;
}
 .align-left {
	 text-align: left;
}
 .align-right {
	 text-align: right;
}
 .float-right {
	 float: right;
}
 .clearfix:after {
	 visibility: hidden;
	 display: block;
	 font-size: 0;
	 content: " ";
	 clear: both;
	 height: 0;
}

.team_name{
	float:right;
	font-weight:bold;
}

/* Style the Image Used to Trigger the Modal */
img {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

img:hover {opacity: 0.7;}

/* The Modal (background) */
#image-viewer {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.9);
}
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}
.modal-content { 
    animation-name: zoom;
    animation-duration: 0.6s;
}
@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}
#image-viewer .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}
#image-viewer .close:hover,
#image-viewer .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}

 
</style>