<template>
    <div class="file_manager">
        <div class="file_manager_block" id="files_list_app">

            <div>
                <div class="files_list table-responsive">
                    <table class="table">

                        <thead>
                            <tr>
                                <th></th>
                                <th>Файл</th>
                                <th>Дата изменения</th>
                                <th>Размер</th>
                                <th>Формат</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(file, name) in files">
                                <td>
                                    <input type="checkbox" :checked="checkedFiles.indexOf(name) >= 0" @change="checkFile" :value="name" :name="'file_items[' + file.path + ']'">
                                </td>
                                <td>
                                    <div class="file_extension">
                                        <img :src="file.association.preview" v-if="file.association.isImage">
                                        <span v-else v-html="file.association.icon"></span>
                                    </div>
                                </td>
                                <td class="file-date">{{ file.date }}</td>
                                <td class="file-size">{{ file.size }}</td>
                                <td>{{ file.extension }}</td>
                                <td><span @click="showInfo(file)" class="btn btn-primary btn-sm filemanager-file-info">Подробнее</span></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>


            <div class="file_info col-md-4" v-show="showInfoForm">
                <div class="file_info_block">

                    <div class="form-group text-right">
                        <a href="" @click="closeInfo" class="btn btn-sm btn-danger">Закрыть ×</a>
                    </div>

                    <p>Выберите файл для подробной информации</p>
                    <div class="file_info_block_description">

                        <div class="image" v-if="selectedFile.isImage">
                            <img :src="selectedFile.src" id="file-image">
                        </div>

                        <div><span>Размер:</span> {{ selectedFile.size }}</div>
                        <div><span>Дата изменения:</span> {{ selectedFile.date }}</div>

                        <div class="form-group fileUrl">
                            Ссылка на файл (оригинал):
                            <div class="input-group">
                                <input type="text" :value="selectedFile.src" class="form-control">
                                <span class="input-group-btn">
                                    <a class="btn btn-primary btn-copy" @click="copyToClipBoard" title="Скопировать ссылку">
                                        <i class="fa fa-clone" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="form-group fileUrl" v-if="selectedFile.isImage">
                            Ссылка на файл (миниатюра):
                            <div class="input-group">
                                <input type="text" :value="selectedFile.miniature" class="form-control">
                                <span class="input-group-btn">
                                    <a class="btn btn-primary btn-copy" @click="copyToClipBoard" title="Скопировать ссылку">
                                        <i class="fa fa-clone" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="form-group fileUrl" v-if="selectedFile.isImage">
                            Ссылка на файл (превью):
                            <div class="input-group">
                                <input type="text" :value="selectedFile.preview" class="form-control">
                                <span class="input-group-btn">
                                    <a class="btn btn-primary btn-copy" @click="copyToClipBoard" title="Скопировать ссылку">
                                        <i class="fa fa-clone" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div v-show="showDeleteForm" class="row delete_block">
                <div class="col-md-10">
                    Выбрано файлов: <span class="checked-files">{{ this.checkedFiles.length }}</span>
                </div>
                <div class="col-md-2">
                    <a href="" class="btn btn-danger btn-sm" @click="deleteCheckedFiles">
                        удалить
                    </a>
                </div>
            </div>

        </div>
    </div>
</template>


<script>
    export default  {
        props: [
            'routeGet',
            'routeDelete',
        ],
        data: function() {
            return {
                files: [],
                checkedFiles: [],
                showDeleteForm: false,
                showInfoForm: false,
                selectedFile: {
                    src: '',
                    miniature: '',
                    preview: '',
                    size: '',
                    extension: '',
                    date: '',
                    isImage: false,
                },
            }
        },
        mounted() {
            this.get();
        },
        methods: {

            get() {
                axios.get(this.routeGet).then((response) => {
                    this.files = response.data;
                    this.checkedFiles = [];
                    this.showDeleteForm = false;
                });
            },

            showInfo(file) {
                this.showInfoForm = true;

                this.selectedFile.size = file.size;
                this.selectedFile.date = file.date;

                this.selectedFile.isImage = file.association.isImage;

                this.selectedFile.src = file.association.original;
                this.selectedFile.miniature = file.association.miniature;
                this.selectedFile.preview = file.association.preview;

            },

            closeInfo(e) {
                this.showInfoForm = false;
                e.preventDefault();
            },

            copyToClipBoard(e) {
                let copyText = e.currentTarget.parentNode.parentNode.querySelector("input");
                copyText.select();
                document.execCommand('copy');
            },

            checkFile(e) {
                if (e.currentTarget.checked) {
                    this.checkedFiles.push(e.currentTarget.value);
                } else {
                    let index = this.checkedFiles.indexOf(e.currentTarget.value);
                    this.checkedFiles.splice(index, 1);
                }

                this.showDeleteForm = (this.checkedFiles.length > 0) ? true : false;
            },

            deleteCheckedFiles(e) {

                axios.post(this.routeDelete, {
                    'file_items': this.checkedFiles
                })
                    .then(() => this.get())
                    .catch((error) => {
                        alert('Произошла ошибка. Пожалуйста повторите еще раз!');
                    });

                e.preventDefault();
            }

        }
    }
</script>
