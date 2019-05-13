<template>
    <div>
        <input type="file" id="selectedFile" style="display: none;" @change="onChange" />
        <input type="button" class="btn btn-success btn-block" id="upload-btn" value="Upload" onclick="document.getElementById('selectedFile').click();" />
    </div>
</template>

<script>
    export default {
        methods: {
            onChange(e) {
                if (!e.target.files.length) return;
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => {
                    let src = e.target.result;
                    this.$emit('loaded', {src, file});
                };
            }
        }
    }
</script>