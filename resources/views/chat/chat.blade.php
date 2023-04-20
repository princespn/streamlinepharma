<style>

.chat-window .col-md-2, .col-md-10{
    padding:0;
}
.chat-window .panel{
    margin-bottom: 0px;
}
.chat-window{
	z-index: 99999999999;
    bottom:0;
    position:fixed;
    float:right;
    margin-left:10px;
	right:0px;
	display:none;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.chat-window .icon_minim{
    padding:2px 10px;
}
.chat-window .msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  min-height: 300px;
  overflow-x:hidden;
}
#btn-chat{
	background: #f93065; 
}
.chat-window .top-bar {
  background: #f93065;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.chat-window .msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.chat-window .messages {
  background: white;
  padding: 10px;
  border-radius:15px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.chat-window .messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.chat-window .messages > time {
    font-size: 11px;
    color: #ccc;
}
.chat-window .msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}
.chat-window img {
    display: block;
    width: 100%;
}
.chat-window .avatar {
    position: relative;
}
.chat-window .base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.chat-window .base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.chat-window .base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.chat-window .msg_sent > time{
    float: right;
}



.chat-window .msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.chat-window .msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.chat-window .msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.chat-window .panel-footer{
	padding:0px;
}
.chat-window .btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
.chat-window .btn-group.dropup input{
	border:0px;
}
</style>