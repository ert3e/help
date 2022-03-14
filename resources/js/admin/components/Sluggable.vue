<template>
    <div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" :value="this.newTitle" @keyup="updateSlug">
        </div>

        <div class="form-group">
            <label for="slug">Алиас</label> <a href="#" @click="toughUpdate" v-if="!this.new" class="small text-primary">(обновить)</a>
            <input type="text" name="slug" id="slug" class="form-control" :value="this.newSlug">
        </div>
    </div>
</template>


<script>
    export default  {
        props: [
            'title', 'slug', 'new'
        ],
        data: function() {
            return {
                'newTitle': this.title,
                'newSlug': this.slug,
            }
        },
        methods: {

            toughUpdate(e) {

                this.newSlug = this.toSlug(this.newTitle);
                e.preventDefault();

            },

            updateSlug(e) {

                this.newTitle = e.target.value;

                if (this.new) {
                    this.newSlug = this.toSlug(this.newTitle);
                }

            },

            toSlug(string) {

                string = String(string);

                let options = {
                    'delimiter': '-',
                    'limit': undefined,
                    'lowercase': true,
                    'replacements': {},
                    'transliterate': true,
                };

                var char_map = {
                    // Latin
                    'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
                    'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
                    'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
                    'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
                    'ß': 'ss',
                    'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c',
                    'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i',
                    'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o',
                    'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th',
                    'ÿ': 'y',

                    // Latin symbols
                    '©': '(c)',

                    // Russian
                    'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
                    'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
                    'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
                    'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Shch', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'Es', 'Ю': 'Yu',
                    'Я': 'Ya',
                    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
                    'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
                    'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
                    'ч': 'ch', 'ш': 'sh', 'щ': 'shch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'es', 'ю': 'yu',
                    'я': 'ya',

                    // Ukrainian
                    'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
                    'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',
                };

                // Make custom replacements
                for (var k in options.replacements) {
                    string = string.replace(RegExp(k, 'g'), options.replacements[k]);
                }

                // Transliterate characters to ASCII
                if (options.transliterate) {
                    for (var k in char_map) {
                        string = string.replace(RegExp(k, 'g'), char_map[k]);
                    }
                }

                // Replace non-alphanumeric characters with our delimiter
                var alnum = RegExp('[^a-z0-9]+', 'ig');
                string = string.replace(alnum, options.delimiter);

                // Remove duplicate delimiters
                string = string.replace(RegExp('[' + options.delimiter + ']{2,}', 'g'), options.delimiter);

                // Truncate slug to max. characters
                string = string.substring(0, options.limit);

                // Remove delimiter from ends
                string = string.replace(RegExp('(^' + options.delimiter + '|' + options.delimiter + '$)', 'g'), '');

                string = options.lowercase ? string.toLowerCase() : string;

                return string;
            }
        }
    }
</script>
