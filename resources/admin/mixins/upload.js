export default {
    events: {
        onFileClick: function (files) {

        },
        onFileChange: function (files) {

        },
        onFileProgress: function (e) {

        },
        beforeFileUpload: function (file) {

        },
        onFileUpload: function (file, response) {
            if (this.data && response && response.file) {
                this.data.image = response.file;
            }
        },
        afterFileUpload: function (file) {

        },
        onAllFilesUploaded: function (allFiles) {

        },
        onFileError: function (file, e) {

        }
    }
}