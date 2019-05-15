<template>
    <div>
        <clipper-basic class="my-clipper" ref="clipper" :src="imgURL" :ratio="1" v-show="!resultURL">
            <div class="placeholder" slot="placeholder" style="position: relative">
                <img src="/avatar/default.jpg">
                <div class="overlay" style="position: absolute; top:0; left: 0; width: 100%; height:100%; z-index:9999; padding-top: 50%;">
                    <image-upload @loaded="onLoad" @error="uploadError" style="margin-top:-20px; display: none"></image-upload>
                </div>
            </div>
        </clipper-basic>
        <div class="alert alert-danger" v-if="errorMSG" v-text="errorMSG"></div>
        <div style="position: relative" v-show="resultURL">
            <img class="result img-fluid" :src="resultURL" alt="">
            <div class="overlay" style="position: absolute; top:0; left: 0; width: 100%; height:100%; z-index:9999; padding-top: 50%;">
                <div class="btn btn-danger btn-sm btn-block" style="display:none" @click="reset">löschen</div>
            </div>
        </div>
        <div @click="getResult" class="btn btn-success btn-block btn-sm" v-show="cropBTN">
            <img src="/icons/crop.png" class="img-fluid" width="25" height="25">
            zuschneiden
        </div>
        <input type="hidden" v-model="resultURL" name="crop">
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
                cropBTN: false,
                errorMSG: ''
            }
        },
        methods: {
            getResult: function () {
                const canvas = this.$refs.clipper.clip();//call component's clip method
                this.resultURL = canvas.toDataURL("image/jpg", 1);//canvas->image
                this.cropBTN = false;
            },
            onLoad: function (avatar) {
                this.errorMSG = '';
                this.imgURL =  avatar.src;
                this.cropBTN = true;
                this.uploadBTN = false;
            },
            reset: function () {
                this.imgURL = '';
                this.resultURL = '';
            },
            uploadError: function (message) {
                this.errorMSG = message;
            }
        }
    }
</script>

<style>
    .overlay:hover div {
        display: block !important;
    }
</style>