<style>
    .file-upload-label {
        display: inline-block;
        position: relative;
        margin: 0 !important;
        padding: 0 !important;
    }

    .file-upload-btn {
        margin-bottom: 0 !important;
    }

    .file-upload-btn + input {
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
<template>

    <div class="{{ class }} vue-upload">
        <label :for="name" class="file-upload-label">
            <span class="file-upload-btn btn btn-primary" v-if="changeUpload">选择上传</span>
            <input type="file" class="form-control" name="{{ name }}" id="{{ id || name }}" accept="{{ accept }}"
                   @click="fileInputClick"
                   @change="fileInputChange" multiple="{{ multiple }}">
            <slot></slot>
        </label>
        <button type="button" class="btn btn-primary" @click="fileUpload" v-if="showBtn">上传文件</button>
    </div>

</template>

<script>

    // upload file component

    export default {
        // data from parent
        props: {
            class: {
                type: String,
                default: ''
            },
            name: {
                type: String,
                default: 'file'
            },
            id: String,
            action: {
                type: String,
                required: true
            },
            accept: String,
            multiple: String,
            showBtn: {
                type: Boolean,
                default: false
            },
            changeUpload: {
                type: Boolean,
                default: true
            },
            headers: Object,
            params: Object,
        },
        data: function () {
            return {
                files: []
            }
        }
        ,
        methods: {
            // click the input
            fileInputClick: function () {
                this.$dispatch('onFileClick', this.files);
            }
            ,
            fileInputChange: function () {
                var id = this.id || this.name;
                var element = document.getElementById(id);
                this.files = element.files;
                this.$dispatch('onFileChange', this.files);
                if (this.changeUpload) {
                    this.fileUpload();
                }
            }
            ,
            _onProgress: function (e) {
                e.percent = (e.loaded / e.total) * 100;
                this.$dispatch('onFileProgress', e);
            }
            ,
            // upload handle
            _handleUpload: function (file) {
                this.$dispatch('beforeFileUpload', file);
                let form = new FormData(),
                        xhr = new XMLHttpRequest();
                try {
                    form.append('Content-Type', file.type || 'application/octet-stream');
                    form.append('file', file);
                    if (this.params) {
                        for (let param in this.params) {
                            form.append(param, this.params[param]);
                        }
                    }
                } catch (e) {
                    this.$dispatch('onFileError', file, e);
                    return;
                }

                // create promise handle the xhr
                return new Promise(function (resolve, reject) {
                    xhr.upload.addEventListener('progress', this._onProgress, false);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState < 4) {
                            return;
                        }
                        if (xhr.readyState < 400) {
                            let res = JSON.parse(xhr.responseText);
                            this.$dispatch('onFileUpload', file, res);
                            resolve(file);
                        } else {
                            let err = JSON.parse(xhr.responseText);
                            err.status = xhr.status;
                            err.statusText = xhr.statusText;
                            this.$dispatch('onFileError', file, err);
                            reject(err);
                        }
                    }.bind(this);

                    xhr.onerror = function () {
                        let err = JSON.parse(xhr.responseText);
                        err.status = xhr.status;
                        err.statusText = xhr.statusText;
                        this.$dispatch('onFileError', file, err);
                        reject(err);
                    }.bind(this);

                    xhr.open('POST', this.action, true);
                    if (this.headers) {
                        for (let header in this.headers) {
                            xhr.setRequestHeader(header, this.headers[header])
                        }
                    }
                    xhr.send(form);
                    this.$dispatch('afterFileUpload', file);
                }.bind(this));
            }
            ,
            fileUpload: function () {
                if (this.files.length > 0) {
                    var arrayOfPromises = Array.prototype.slice.call(this.files, 0).map(function (file) {
                        return this._handleUpload(file);
                    }.bind(this));
                    // wait for everything to finish
                    Promise.all(arrayOfPromises).then(function (allFiles) {
                        this.$dispatch('onAllFilesUploaded', allFiles);
                    }.bind(this)).catch(function (err) {
                        this.$dispatch('onFileError', this.files, err);
                    }.bind(this));
                } else {
                    // someone tried to upload without adding files
                    var err = new Error("No files to upload for this field");
                    this.$dispatch('onFileError', this.files, err);
                    console.log('No files to upload for this field');
                }
            }
        }
    }

</script>
