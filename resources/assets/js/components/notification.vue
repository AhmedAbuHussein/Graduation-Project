<template>
    <li class="nav-item dropdown">
        
        <a id="notify" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-bell-o fa-2x text-dark"></i>
        </a>
        <b id="notifycount" v-text="lens">{{lens}}</b>
        
        <div class="dropdown-menu text-right notificationtemplate" aria-labelledby="notify">
            <p v-if="!lens" class="text-center py-0 my-0">لا يوجد اشعارات لعرضها</p>
            <a  v-for="not in notification" :key="not.id" class="dropdown-item notificationvue" :href="'store/'+not.data.itemid">تم التعديل علي مخزن <b>{{userstore}}</b> بواسطه كاتب الشطب لمراجه وحفظ التغير يرجي الدخول هنا <i>{{not.created_at}}</i></a>
        </div>
    </li>
</template>
<script>
    import axios from "axios";
    export default {
        data(){
            return {
                notification:[],
                lens:"",
                userstore:""
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

