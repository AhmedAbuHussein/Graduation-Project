<template>
    <li class="nav-item dropdown">
        
        <a id="notify" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-bell-o fa-2x text-dark"></i>
        </a>
        <b id="notifycount" v-text="lens">{{lens}}</b>
        
        <div class="dropdown-menu text-right notificationtemplate" aria-labelledby="notify">
            <p v-if="!lens" class="text-center py-0 my-0">لا يوجد اشعارات لعرضها</p>
            <div id="noti" v-if="this.role == 1">
                <a v-for="not in notification" :key="not.id"  class="dropdown-item notificationvue" :href="'writer?notify='+not.id+'&item='+not.data.itemid">تم التعديل علي مخزن <b>{{userstore}}</b> بواسطه كاتب الشطب لمراجه وحفظ التغير يرجي الدخول هنا <i>{{not.created_at}}</i></a>
            </div>
            <div id="notiwriter" v-else>
                <a class="dropdown-item notificationvue" v-for="not in notification" :key="not.id" :href="'readed?notify='+not.id">تم حفظ التعديل الذي قمت به من قبل امين المخزن</a>
            </div>
            
        </div> 
    </li>
</template>

<script>
    $(function () {

        var message ;
        var slh = new StreamLabHtml()
        var sls = new StreamLabSocket({
            appId:"f8103684-4caf-4d38-abaa-18f81e5c9d84",
            channelName:"FCINotification",
            event:"*",
            });
        
        sls.socket.onmessage = function(res){
            slh.setData(res);
            console.log(slh.getSource())
            if(slh.getSource() == "messages"){
                message = slh.getMessage();
                if(!message.msg){
                    $('#noti').prepend("<a class='dropdown-item notificationvue' href='writer?notify="+message.notify+"&item="+message.itemid+"'>تم التعديل علي المخزن <b>الان</b> بواسطه كاتب الشطب لمراجه وحفظ التغير يرجي الدخول هنا <i>"+new Date("yyyy-mm-dd")+"</i></a>");
                }else{
                    $('#notiwriter').prepend("<a class='dropdown-item notificationvue' href='readed?notify='"+message.notify+">تم حفظ التعديل الذي قمت به من قبل امين المخزن</a>");
                }
            }
        }
    });
    
    import axios from "axios";
    export default {
        props:["role"],
        data(){
            return {
                notification:[],
                lens:"",
                userstore:"",
            }
        },
        computed:{
            getNotify(){
                
                axios.post('/notification/get').then((result) => {
                    this.notification = result.data[0];
                    this.userstore = result.data[1];
                    this.lens = this.notification.length;
                }).catch((err) => {
                    console.log(err);
                });
            }
        },
        created(){
            this.getNotify;
        }

    }    
</script>
<style>
    #notifycount{
        position: absolute;
        top: 0.2rem;
        right: 0.2rem;
        width: 1.2rem;
        height: 1.2rem;
        border-radius: 100%;
        background: #f35a68;
        line-height: 1.2rem;
        text-align: center;
        color: white;
    }
    .notificationtemplate{
        width:18rem;

    }
    .notificationtemplate a{
        white-space: normal;
        border-bottom: 0.1rem solid #f5f5f5;
        position: relative;
        padding-bottom: 1.1rem;
    }
    .notificationtemplate a i{
        position: absolute;
        bottom: 0;
        left: 8px;
        font-size: 8pt;
    }
    .notificationtemplate a:last-child{
        border-bottom: none;
    }

    
</style>

