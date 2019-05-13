<template>
    <div>
        <clipper-basic class="my-clipper" ref="clipper" :src="imgURL" :ratio="1" v-if="!resultURL">
            <div class="placeholder" slot="placeholder" style="position: relative">
                <img src="/avatar/default.jpg">
                <div class="overlay" style="position: absolute; top:0; left: 0; width: 100%; height:100%; z-index:9999; padding-top: 50%;">
                    <image-upload @loaded="onLoad" style="margin-top:-20px; display: none"></image-upload>
                </div>
            </div>
        </clipper-basic>
        <div style="position: relative" v-if="resultURL">
            <img class="result img-fluid" :src="resultURL" alt="">
            <div class="overlay" style="position: absolute; top:0; left: 0; width: 100%; height:100%; z-index:9999; padding-top: 50%;">
                <div class="btn btn-danger btn-sm btn-block" style="display:none" @click="reset">löschen</div>
            </div>
        </div>
        <div @click="getResult" class="btn btn-success btn-block btn-sm" v-if="cropBTN">
            <img src="/icons/crop.png" class="img-fluid" width="25" height="25">
            zuschneiden
        </div>
    </div>
</template>

<script>
    import VuejsClipper from 'vuejs-clipper';
    import ImageUpload from './ImageUpload';

    export default {
        name: "ImageUploadCrop",
        components: {VuejsClipper, ImageUpload},
        data: function () {
            return {
                imgURL: '',
                resultURL: '',
                cropBTN: false
            }
        },
        methods: {
            getResult: function () {
                const canvas = this.$refs.clipper.clip();//call component's clip method
                this.resultURL = canvas.toDataURL("image/jpg", 1);//canvas->image
                this.cropBTN = false;
            },
            onLoad: function (avatar) {
                this.imgURL = avatar.src;
                this.cropBTN = true;
            },
            reset: function () {
                this.imgURL = '';
                this.resultURL = '';
            }
        }
    }
</script>

<style>
    .overlay:hover div {
        display: block !important;
    }
</style>