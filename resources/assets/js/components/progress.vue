<template>

      <div class="row">
            
            <div class="col-md-12  col-6 infoStorProg mb-3 text-right">
                <!--مخزن المستهلك-->
                <label>مخزن المستهلك</label>
                <div class="progress dir">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" :style="'width:'+mostdem+'%'"><span>مصرف <bdi>{{mostdem}} %</bdi></span></div>
                </div>
            </div>
            <div class="col-md-12 col-6 infoStorProg mb-3 text-right">
                <!--محزن المستديم-->
                <label>مخزن المستديم</label>
                <div class="progress dir">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" :style="'width:'+mostahlk+'%'"><span>مصرف <bdi>{{mostahlk}} %</bdi></span></div>
                </div>
            </div>
            <div class="col-md-12  col-6 infoStorProg mb-3 text-right">
                <!--مخزن الخامات-->
                <label>مخزن الخامات</label>
                <div class="progress dir">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" :style="'width:'+khamat+'%'"><span>مصرف <bdi>{{khamat}} %</bdi></span></div>
                </div>
            </div>
            <div class="col-md-12  col-6 infoStorProg text-right">
                <!-- محزن الكهنه-->
                <label>محزن الكهنه</label>
                <div class="progress dir">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" :style="'width:'+khnah+'%'"><span>مصرف <bdi>{{khnah}} %</bdi></span></div>
                </div>
            </div>
        </div>

</template>
<script>
import axios from 'axios';
export default {
    data(){
        return{
            mostdem:80,
            mostahlk:60,
            khamat:40,
            khnah:20
        }
    },
    computed:{
        getdata(){
            axios.post("/progress").then((result) => {
                var data = result.data;
                this.mostdem = data[0];
                this.mostahlk = data[1];
                this.khamat = data[2];
                this.khnah = data[3];
                console.log(data);
            }).catch((err) => {
                console.log(err);
            });
        }
    },
    created(){
        this.getdata;
    }
}
</script>
