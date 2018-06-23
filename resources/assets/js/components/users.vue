<template>
  
  <div class="card cardtable">
        <div class="card-heading bg-info p-2" style="z-index:3">
            <div class="row">
                <div class="col-sm-4">
                    <input class="form-control" v-model="search" type="search" style="direction:rtl" placeholder="بحث بالاسم" />
                </div>
            </div>
            
        </div>
        <div class="card-body pt-0">
           <div class="cardtable">
                <table class="table table-striped" style="direction:rtl;">
                    <thead>
                    <tr>
                        <th>التسلسل</th>
                        <th>اسم المستخدم</th>
                        <th>الوظيفه</th>
                        <th>اسم المخزن</th>
                        <th>الإيميل</th>
                        <th>رقم التليفون</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody id="tableusers">

                    <tr v-for="user in filteruser" :key="user['id']">
                        <td>{{user['id']}}</td>
                        <td><a class="emp_name" :href="'/profile/'+user['id']">{{user['fullname']}}</a></td>
                        <td>{{user['job_name']}}</td>                      
                        <td>{{user['storename']}}</td>
                        <td>{{user['email']}}</td>
                        <td>{{user['phone']}}</td>
                        <td>
                        <a @click="confirmfun(user,$event)" v-if="userrole == 0 && user['id'] != 1" :href="'/deleteuser/'+user['id']" :data-class="user['name']" class="btn btn-danger btn-sm confirm">حذف <i class="fa fa-close"></i></a>
                                
                        <a v-if="userrole == 0" :href="'/modify?id='+user['id']" class="btn btn-success btn-sm">تعديل <i class="fa fa-edit"></i></a>
                           
                        <p v-else class="disabled">Disabled</p>
                            
                        </td>
                    </tr>
                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</template>

<script>

import axios from 'axios';

export default {
    props:['userrole'],
    data(){
        return{
            users:[],
            search:"",
        };
    },
    computed:{
        filteruser(){
            var app = this;
            return this.users.filter(function (user) { 
                return user.fullname.indexOf(app.search) !== -1;
             });
        },
        
    },
    methods:{
        getUser(){
            axios.get('/user').then(result => {
                this.users = result.data.users;
                
            }).catch((err) => {
                console.log(err);
            });
        },
        confirmfun(user,e) {
            e.preventDefault();
            swal({
                text: "هل انت متاكد من حذف ("+user['fullname']+")؟",
                title: "اذا تم الحذف لن تستطيع استرجاعه",
                icon: "warning",
                buttons: ["لا", "نعم"],
                dangerMode: true,
            }).then((value) => {
                if (value) {
                    this.deleteUser("/deleteuser/"+user['id']);
                } else {
                    swal("تم الغاء عمليه الحذف");
                }

            });
        },
        deleteUser(url) {
            axios.post(url).then(response=> {
                this.users = response.data.users;                
                swal("تم الحذف بنجاح");
            }).catch(err=>{
                console.log(err);
            });

        }
        
        
    },
    created(){
        this.getUser();
    }
}

</script>

