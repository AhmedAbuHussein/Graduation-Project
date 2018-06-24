<template>
    <div class="col-md-4 mygraphs-tor">
        <div class="theinfo">
            <div class="h2">
                <span>العهد </span>
                <div class="option">
                    <i class="fa fa-gears select-pos"></i>
                    <!--option for the select the time-->
                    <select id="thetime" class="selectbox form-control">
                        <option v-for="date in dates" :key="date" :value="date">{{date}}</option>
                    </select>
                </div>

            </div>
            <div class="mycontent text-right">
                <div class="row">
                    <div class="col-md-12 col-6 infoStorProg mb-3">
                        <!--منتج 1-->
                        <label>المستهلك</label>
                        <div class="progress dir">
                            <div class="progress-bar progress-bar-danger  " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%"><span style="font-size: 19px;">عهد <bdi>80 %</bdi></span></div>
                        </div>
                    </div>
                    <div class="col-md-12  col-6 infoStorProg mb-3">
                        <!--منتج 2-->
                        <label>المستديم</label>
                        <div class="progress dir">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:40%"><span style="font-size: 19px;">عهد<bdi> 40 %</bdi></span></div>
                        </div>
                    </div>
                    <div class="col-md-12  col-6 infoStorProg mb-3">
                        <!--منتج 3-->
                        <label>الخامات</label>
                        <div class="progress dir">
                            <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:60%"><span style="font-size: 19px;">عهد <bdi>60 %</bdi></span></div>
                        </div>
                    </div>
                    <div class="col-md-12  col-6 infoStorProg">
                        <!-- منتجات اخرى-->
                        <label>الكهنه</label>
                        <div class="progress dir">
                            <div class="progress-bar progress-bar-danger " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:30%"><span style="font-size: 19px;">عهد <bdi>30 %</bdi></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return{
                dates:[],
            }
        },
        computed:{
            
            

        }


    }
</script>
