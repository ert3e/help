<template>
    <div class="upload-file-form" :data-files-id="this.id">
        <div class="form-group">
            <label>{{ this.title ? this.title : 'Файлы для загрузки' }} {{ this.max ? '(макс. ' + this.max + ')' : ''}}</label>

            <label :for="'files-input-' + this.id" class="files-box">
                <draggable v-if="this.files.length > 0" @change="sort" :move="onMove" v-model="files" class="files-box-list">
                    <div v-for="file in files" :class="['files-box-file', {'local': file.key > 0} ]" :key="file.key">
                        <span v-if="file.name != undefined">{{ file.name }}</span>
                        <img :src="file.url" v-else>
                        <a href="#" @click="removeImage(file, $event)" class="delete-local badge badge-danger">удалить</a>
                    </div>
                </draggable>
            </label>

            <div class="files-box-inputs">

            </div>

            <input @change="addFiles" :id="'files-input-' + this.id" :name="[this.name + (this.multiple ? '[]' : '')]" type="file" :class="['form-control', 'files-input', {'all-files': this.allFiles} ]" :multiple="this.multiple">
        </div>
    </div>
</template>


<script>
    import draggable from 'vuedraggable';

    export default  {
        components: {
            draggable,
        },
        props: [
            'initFiles', 'multiple', 'allFiles', 'name', 'id', 'title', 'sortableUrl', 'max',
        ],
        data: function() {
            return {
                'allowedImageExtensions': [
                    'png', 'gif', 'jpg', 'jpeg'
                ],
                'files': [],
                'initialIndexes': [],
            }
        },

        mounted: function() {
            if (this.initFiles.length > 0) {
                this.files = this.initFiles;
            }

            for (const [, file] of Object.entries(this.files)) {
                this.initialIndexes.push(file.key);
            }

        },
        methods: {

            onMove({ relatedContext, draggedContext }) {
                const relatedElement = relatedContext.element;
                const draggedElement = draggedContext.element;
                return (
                    (!relatedElement || !relatedElement.fixed) && !draggedElement.fixed
                );
            },

            sort() {

                let i = 0,
                    sortedItems = {};

                for (const [, file] of Object.entries(this.files)) {
                    let currentKey = file.key;

                    if (this.initialIndexes[i] != currentKey) {
                        sortedItems[currentKey] = this.initialIndexes[i];
                        this.initialIndexes[i] = currentKey;
                    }

                    ++i;
                }

                axios.post(this.sortableUrl, {
                    'items': JSON.stringify(sortedItems)
                }).catch(() => alert('Произошла ошибка. Пожалуйста повторите еще раз!'));

            },

            removeImage(image, e) {

                if (image.key > 0) {

                    axios.get(image.routeDelete).then((response) => {
                        if (response.data.result) {
                            e.target.parentNode.remove();
                        }
                    }).catch(() => alert('Произошла ошибка. Пожалуйста повторите еще раз!'));

                } else {
                    document.querySelector('input[data-preload="' + image.preload + '"]').remove();
                    e.target.parentNode.remove();
                }

                e.preventDefault();

            },

            addFiles(filesInput) {

                let input = filesInput.target,
                    form;

                [].forEach.call(input.parents('.upload-file-form'), (element) => {
                    form = element;
                });

                if ((input.files).length > 0) {

                    let allowedFiles = null;

                    if (this.max) {

                        let max = parseInt(this.max),
                            filesListLength = document.querySelectorAll('.files-box-list > *').length,
                            all = filesListLength + (input.files).length;

                        if (all > max) {
                            allowedFiles = max - filesListLength;
                            alert('Максимально количество изображений - ' + max);
                        }
                    }

                    for (let [key, file] of Object.entries(input.files)) {

                        let counter = parseInt(key) + 1;

                        // прекращаем добавление файлов если превышен лимит
                        if (allowedFiles != null && counter > allowedFiles) {
                            continue;
                        }

                        let fileName = file.name,
                            extension = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();

                        if (this.allowedImageExtensions.includes(extension) || input.classList.contains('all-files')) {
                            let reader = new FileReader();

                            reader.onload = (e) => {

                                let randomKey = Math.round(-10000 - 0.5 + Math.random() * (-1 - (-10000) + 1));

                                this.files.push({
                                    'key': randomKey,
                                    'url': e.target.result,
                                    'name': this.allowedImageExtensions.includes(extension) ? undefined : file.name,
                                    'preload': e.loaded,
                                    'routeDelete': '#',
                                    'fixed': true,
                                });

                                let input = document.createElement('input');

                                input.setAttribute('data-preload', e.loaded);
                                input.type = 'hidden';
                                input.name = 'images[]';
                                input.value = e.target.result;

                                form.querySelector('.files-box-inputs').appendChild(input);

                            };

                            reader.readAsDataURL(file);
                        }

                    }
                }
            }
        }
    }
</script>
